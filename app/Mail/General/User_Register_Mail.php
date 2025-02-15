<?php

namespace App\Mail\General;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class User_Register_Mail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }


    public function build()
    {
        return $this->view('mail.general.user_register_mail', [
            'user' => $this->user,
        ])->subject('OTP Verification');
    }
}
