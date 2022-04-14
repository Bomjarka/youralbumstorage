<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
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
        'path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function album()
    {
        return $this->belongsToMany(Album::class, 'album_photos', 'photo_id');
    }

    public function associateAlbumPhoto($albumid): void
    {
        AlbumPhotos::create([
            'album_id' => $albumid,
            'photo_id' => $this->id,
        ]);
    }

    public function disassociateAlbumPhoto($albumid)
    {
        $albumPhoto = AlbumPhotos::whereAlbumId($albumid)->wherePhotoId($this->id)->first();
        $albumPhoto->delete();
    }
}
