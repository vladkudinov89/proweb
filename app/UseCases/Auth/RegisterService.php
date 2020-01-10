<?php

namespace App\UseCases\Auth;

use App\Entities\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\Admin\SendAdminMail;
use App\Mail\Auth\User\SendUserMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;

class RegisterService
{
    private $mailer;
    private $dispatcher;

    public function __construct(Mailer $mailer , Dispatcher $dispatcher)
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
    }

    public function register(RegisterRequest $request): User
    {
        $user = User::register(
            $request['email'],
            $request['password']
        );

        $this->mailer->to($user->email)->send(new SendUserMail($user));

        $this->mailer->to($this->admin()->email)->send(new SendAdminMail($this->admin()));

        $this->dispatcher->dispatch(new Registered($user));

        return $user;
    }

    private function admin(): User
    {
        return User::getAdmin();
    }
}
