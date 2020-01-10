<?php

namespace App\Mail\Auth\Admin;

use App\Entities\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAdminMail extends Mailable
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
            ->subject('Message to Admin')
            ->markdown('emails.auth.register.admin.success');
    }
}
