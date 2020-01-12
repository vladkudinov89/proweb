<?php

namespace App\Exceptions\User;

class UserDoesNotExistException extends \DomainException
{
    public function __construct(string $message = 'The User does\'t exists', $code = 404, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

