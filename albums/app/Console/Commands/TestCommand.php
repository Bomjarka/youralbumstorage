<?php

namespace App\Console\Commands;


use App\Helpers\RoleHelper;
use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';

    public function handle()
    {
        $photo = Photo::find(58);
        dd(storage_path($photo->path));
    }
}
