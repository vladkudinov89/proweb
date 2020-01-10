<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $about
 * @property string $email
 * @property string $password
 * @property string $verify_token
 * @property string $gender
 * @property string $role
 * */
class User extends Authenticatable
{
    use Notifiable;

    public const STATUS_MALE = 'male';
    public const STATUS_FEMALE = 'female';

    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','about', 'email', 'password','gender', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function rolesList(): array
    {
        return [
            self::ROLE_USER => 'user',
            self::ROLE_ADMIN => 'admin'
        ];
    }
    public static function genderList()
    {
        return [
            self::STATUS_MALE => 'male',
            self::STATUS_FEMALE => 'female'
        ];
    }

    public function getRole():string
    {
        return $this->role;
    }

    public static function register(
        string $email,
        string $password
    ): self
    {
        return static::create([
            'email' => $email,
            'password' => bcrypt($password),
            'verify_token' => Str::uuid(),
            'role' => self::ROLE_USER
        ]);
    }

    public static function getAdmin(): User
    {
        return User::where('role', self::ROLE_ADMIN)->first();
    }

}
