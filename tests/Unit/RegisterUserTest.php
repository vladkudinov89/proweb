<?php

namespace Tests\Unit;

use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function success_create_user()
    {
        $user = User::create([
            'email' => 'test@test.ru',
            'password' => bcrypt('secret'),
            'role' => 'user'
        ]);

        self::assertNotEmpty($user);

        self::assertEquals('test@test.ru', $user->email);

        self::assertNotEmpty($user->password);

        self::assertNotEquals(bcrypt('secret'), $user->password);

        self::assertNotEmpty($user->role);

        self::assertEquals('user', $user->getRole());
    }

}
