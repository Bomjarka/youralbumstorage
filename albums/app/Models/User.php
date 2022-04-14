<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $lastName
 * @property string $login
 * @property string $email
 * @property string $phone
 * @property mixed $last_name
 * @property mixed $second_name
 * @property mixed $first_name
 * @property bool $is_blocked
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'second_name',
        'last_name',
        'login',
        'email',
        'phone',
        'sex',
        'birthdate',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function fullName()
    {
        return implode(' ', array_filter([$this->first_name, $this->second_name, $this->last_name]));
    }

    public function isBlocked()
    {
        return $this->is_blocked;
    }

    public function albums()
    {
        return $this->hasMany(Album::class)->orderBy('id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('id');
    }
}
