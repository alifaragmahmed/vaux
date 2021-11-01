<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public static function setActiviationEmail(User $user) {
        $link = url('/api/verify?token=' . $user->remember_token);
        $message = view("email.partial.activate", compact("link"));
        $headerImg = url('/images/email_verify.png');
        sendMail($user->email, "Verify your email", $message, $user->first_name, "", $headerImg);
    }
}
