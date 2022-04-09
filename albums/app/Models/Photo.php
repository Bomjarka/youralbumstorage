<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use HasFactory; use SoftDeletes;

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
        $albumPhoto = AlbumPhotos::wherePhotoId($this->id)->first();

        return Album::whereId($albumPhoto->id)->first();
    }
}
