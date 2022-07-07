<?php

namespace App\Models;


use App\Notifications\ResetPassword;
use App\Traits\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $lastName
 * @property string $login
 * @property string $email
 * @property string $phone
 * @property string $sex
 * @property $birthdate
 * @property mixed $last_name
 * @property mixed $second_name
 * @property mixed $first_name
 * @property bool $is_blocked
 * @property bool is_verified
 * @property int $id
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'first_name',
        'second_name',
        'last_name',
        'email',
        'phone',
        'sex',
        'is_verified',
        'is_blocked',
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

    /**
     *
     * Возвращает полное имя пользователя
     *
     * @return string
     */
    public function fullName(): string
    {
        return implode(' ', array_filter([$this->first_name, (is_null($this->second_name) ?? ''), $this->last_name]));
    }

    /**
     *
     * Заблокрован ли пользователь
     *
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->is_blocked;
    }

    public function isVerified(): bool
    {
        return $this->is_verified;
    }

    /**
     *
     * Возвращает все пользовательские альбомы
     *
     * @return HasMany
     */
    public function albums(): HasMany
    {
        return $this->hasMany(Album::class)->orderBy('id');
    }

    /**
     *
     * Возвращает все пользовательские удалённые альбомы
     *
     * @return mixed
     */
    public function trashedAlbums()
    {
        return $this->albums()->onlyTrashed();
    }

    /**
     *
     * Возвраащает все пользовательские фоторафии
     *
     * @return HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class)->orderBy('id');
    }

    /**
     *
     * Возвращает все удалёныее пользователем фотографии
     *
     * @return mixed
     */
    public function trashedPhotos()
    {
        return $this->photos()->onlyTrashed();
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, $this));
    }

}
