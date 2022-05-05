<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 *
 * Модель альбом
 *
 * @property int $user_id
 * @property string $name
 * @property string description
 */
class Album extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    /**
     *
     * Возвращает пользователя, которому принадлежит альбом
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * Возвращает все фото в альбоме
     *
     * @return BelongsToMany
     */
    public function photos(): BelongsToMany
    {
        return $this->belongsToMany(Photo::class, 'album_photos');
    }

    /**
     *
     * Возвращает все удалённые пользователем фотографии альбома
     *
     * @return mixed
     */
    public function trashedPhotos()
    {
        return $this->photos()->onlyTrashed();
    }
}
