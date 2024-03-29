<?php

namespace App\Events\Album;

use App\Models\Album;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteAlbumWithPhotos
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $album;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Album $album)
    {
        $this->album = $album;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
