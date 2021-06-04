<?php

namespace App\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class ValidRecaptcha implements Rule
{
    /**
     * Verify if the reCAPTCHA was successfully passed.
     *
     * @param  string   $attribute
     * @param  mixed    $value
     * @return boolean
     */
    public function passes($attribute, $value)
    {
        $client = new Client([
            'base_uri' => 'https://google.com/recaptcha/api/'
        ]);
        $response = $client->post('siteverify', [
            'query' => [
                'secret'   => config('recaptcha.secret'),
                'response' => $value
            ]
        ]);

        $jsonResponse = json_decode($response->getBody());
        return $jsonResponse->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Supplied incorrect reCAPTCHA answer.';
    }
}
