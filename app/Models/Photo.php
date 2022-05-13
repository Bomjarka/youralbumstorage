<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *Модель Фотографии
 *
 * @property int $id
 */
class Photo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'photo_path',
        'photo_preview_path'
    ];

    /**
     *
     * Возвращает пользователя, которому принадлежит фотография
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * Возвращает альбом, которому принадлежит фотография
     *
     * @return BelongsToMany
     */
    public function album(): BelongsToMany
    {
        return $this->belongsToMany(Album::class, 'album_photos', 'photo_id');
    }

    /**
     *
     * Возвращает удалённый альбом если фото относится
     * к такому альбому (например пользователь удалил альбом, но оставил фотографии)
     *
     * @return mixed
     */
    public function trashedAlbum()
    {
        return $this->album()->onlyTrashed();
    }

    /**
     * Привязываем фото к альбому
     *
     * @param $albumId
     * @return void
     */
    public function associateAlbumPhoto($albumId): void
    {
        AlbumPhotos::create([
            'album_id' => $albumId,
            'photo_id' => $this->id,
        ]);
    }

    /**
     *
     * Отвязываем фото от альбома
     *
     * @param $albumId
     * @return void
     */
    public function disassociateAlbumPhoto($albumId): void
    {
        $albumPhoto = AlbumPhotos::whereAlbumId($albumId)->wherePhotoId($this->id)->first();
        $albumPhoto->delete();
    }
}
