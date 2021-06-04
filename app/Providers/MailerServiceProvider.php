<?php

namespace App\Providers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class MailerServiceProvider extends ServiceProvider
{
    // Specific email vars
    public static $email;
    public static $title;
    public static $messages;
    public static $senderName = 'Classics Cars';

    /**
     * Send email confirmation link
     * @param $email
     * @param $token
     * @param $fname
     * @param $lname
     */
    public static function sendConfirmationEmail($email, $fname, $lname, $token){
        $values = ['header' => 'Hello '.$fname.' '.$lname.'','token' => $token];
        self::$senderName = $fname . ' ' . $lname;
        self::$email = $email;
        self::$title = 'Classics email confirmation!';
        Mail::send('emails.user-email-verification',$values , function ($message) {
            $message->to(MailerServiceProvider::$email, MailerServiceProvider::$senderName)->subject(MailerServiceProvider::$title);
        });
    }
}
