<?php

namespace App\Mail\Auth\User;

use App\Entities\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUserMail extends Mailable
{
    use SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this
            ->subject('Signup Success')
            ->markdown('emails.auth.register.users.success');
    }
}
