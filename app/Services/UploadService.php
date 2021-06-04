<?php
/**
 * Copyright (c) 2020 Derks.IT / Jeroen Derks <jeroen@derks.it> All rights reserved.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 * Proprietary and confidential.
 */

namespace App\Services;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image as ImageFacade;
use Intervention\Image\Image;
use Symfony\Component\HttpFoundation\Response;

class UploadService
{
    /**
     * Handle an uploaded file by storing it to file.
     * @param  Request      $request
     * @param  string       $destination
     * @param  string|null  $field
     * @param  null         $validation
     * @param  User|null    $user
     * @param  boolean      $useBusinessName
     * @return JsonResponse
     */
    public function upload(Request $request, string $destination, string $field = null, $validation = null, User $user = null, bool $useBusinessName = false)
    {
        $file = $this->validate($request, $field, $validation);
        if (!($file instanceof UploadedFile)) {
            return $file;
        }

        list($basename, $extension) = $this->getFilePath($request, $destination, $user, $useBusinessName);

        $filename = $basename . $extension;
        $file->move(public_path($destination), $filename);

        return new JsonResponse([
            'status'    => 'ok',
            'filename'  => $filename,
            'location'  => url($destination) . '/' . $filename,
        ], Response::HTTP_OK, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * Handle an uploaded image by storing it to file, optionally saving a thumbnail image as well.
     *
     * @param  Request       $request
     * @param  string        $destination
     * @param  integer|null  $thumbnailWidth
     * @param  integer|null  $thumbnailHeight
     * @param  string|null   $field
     * @param  boolean       $required
     * @param  User|null     $user
     * @param  boolean       $useBusinessName
     * @return JsonResponse
     */
    public function uploadImage(
        Request $request,
        string  $destination,
        int     $thumbnailWidth  = null,
        int     $thumbnailHeight = null,
        string  $field = null,
        bool    $required = false,
        User    $user = null,
        bool    $useBusinessName = false
    ) {
        $validation                 = ($required ? 'required|' : '') . 'image|mimes:jpeg,png,jpg,svg,webp,gif,bmp|max:16384';
        $file                       = $this->validate($request, $field, $validation);
        list($basename, $extension) = $this->getFileBasenameExtension($file, $user, $useBusinessName);

        // save original image to fisle
        $image    = ImageFacade::make($file->getPathname());
        $mimeType = $file->getMimeType();
        strtok($mimeType, '/');
        $imageType = strtok('+');
        if (in_array($imageType, ['jpeg', 'jpg', 'bmp', ''])) {
            $extension = 'jpg';
        } else {
            $extension = 'png';
        }
        $basenameOriginal = "{$basename}.{$extension}";
        $destinationPath  = public_path($destination);
        if (!is_dir($destinationPath)) {
            @mkdir($destinationPath, 0775, true);
        }

        $filenameOriginal = $destinationPath . '/' . $basenameOriginal;
        $image->save($filenameOriginal);

        // save thumbnail if required
        $basenameResized = $this->saveThumbnail($image, $destinationPath, $basename, $extension, $thumbnailWidth, $thumbnailHeight);

        return new JsonResponse([
            'status'    => 'ok',
            'filename'  => $basenameOriginal,
            'location'  => url($destination) . '/' . $basenameOriginal,
            'thumbnail' => $basenameResized,
        ], Response::HTTP_OK, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @param  Request      $request
     * @param  string|null  $field
     * @param  mixed        $validation
     * @return JsonResponse|UploadedFile
     *
     * @TODO move to validator?
     */
    protected function validate(Request $request, string $field = null, $validation = null)
    {
        if (null === $field) {
            $field = key($_FILES) ?? 'file';
        }

        if (!$request->has($field)) {
            return new JsonResponse(['status' => 'error', 'errors' => [$field => __('Upload field :field not supplied', ['field' => $field])]], Response::HTTP_NOT_ACCEPTABLE);
        }

        if (null !== $validation) {
            $request->validate([
                $field => $validation,
            ]);
        }

        $file = $request->file($field);
        if (!$file) {
            return new JsonResponse(['status' => 'error', 'errors' => [$field => __('Upload field :field is not an uploaded file', ['field' => $field])]], Response::HTTP_NOT_ACCEPTABLE);
        }

        return $file;
    }

    /**
     * Get basename and extension for filename to use to store the uploaded file.
     *
     * @param  UploadedFile  $file
     * @param  User|null     $user
     * @param  boolean       $useBusinessName
     * @return array
     */
    protected function getFileBasenameExtension(UploadedFile $file, User $user = null, bool $useBusinessName = false): array
    {
        $filename  = $file->getClientOriginalName();
        $extension = $file->getExtension() ?: array_slice(explode('.', $filename), -1)[0];

        if ($extension && $extension !== $filename) {
            $filename = substr($filename, 0, -(strlen($extension) + 1));
        }

        // get base name for file
        $basename = trim(preg_replace('/[^\pL\pN]+/', '-', $filename), '-');
        if ('' == $basename) {
            $basename = str_random(32);
        }

        // prefix business name if available
        if (null !== $user && $useBusinessName) {
            $businessName = trim(preg_replace('/[^\pL\pN]+/', '_', $user->businessName), '_');
            if ('' != $businessName) {
                if ('' == $basename) {
                    $basename = $businessName;
                } else {
                    $basename = "{$businessName}-{$basename}";
                }
            }
        }

        $basename = str_limit($basename, 48, '');

        if (null !== $user && !session('isAdmin')) {
            $userId    = $user->userID;
            $basename = "{$userId}-{$basename}";
        }

        return [$basename, $extension];
    }

    /**
     * Save thumbnail of image.
     *
     * @param  Image         $image
     * @param  string        $destination
     * @param  string        $basename
     * @param  integer|null  $thumbnailWidth
     * @param  integer|null  $thumbnailHeight
     * @return string|null
     */
    protected function saveThumbnail(Image $image, string $destination, string $basename, string $extension, int $thumbnailWidth = null, int $thumbnailHeight = null)
    {
        if (null !== $thumbnailHeight) {
            $image = $image->heighten($thumbnailHeight);
        }
        if (null !== $thumbnailWidth) {
            if ($image->width() > $thumbnailWidth) {
                if (null !== $thumbnailHeight) {
                    $image = $image->crop($thumbnailWidth, $thumbnailHeight);
                } else {
                    $image = $image->widen($thumbnailWidth);
                }
            }
        }

        if (null !== $thumbnailWidth || null !== $thumbnailHeight) {
            $dimensions       = $image->width() . 'x' . $image->height();
            $basenameResized  = "{$basename}-{$dimensions}.{$extension}";
            $filenameResized  = $destination . '/' . $basenameResized;

            $image->save($filenameResized);

            return $basenameResized;
        }

        return null;
    }
}
