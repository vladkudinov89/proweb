<?php

namespace Tests\Feature;

use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function success_redirect_to_login_page_start()
    {
        $response = $this->get('/');

        $this->assertGuest();

        $response->assertRedirect('/login');
    }

    /** @test */
    public function success_view_login()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();

        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/profile');
    }

    /** @test */
    public function user_can_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'secret'),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertRedirect('/profile');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_cannot_login_with_incorrect_password()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('secret'),
        ]);

        $response = $this->from('/login')
            ->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('/login');

        $response->assertSessionHasErrors('email');

        $this->assertTrue(session()->hasOldInput('email'));

        $this->assertFalse(session()->hasOldInput('password'));

        $this->assertGuest();
    }

    /** @test */
    public function user_success_register()
    {
        $response = $this->post('register' , [
            'email' => 'john@example.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);

        $response->assertRedirect('/profile');

    }


}
