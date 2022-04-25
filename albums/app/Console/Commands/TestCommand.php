<?php

namespace App\Console\Commands;


use App\Models\User;
use App\Notifications\DownloadPhotosNotification;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';

    public function handle()
    {
        $user = User::find(2);
        $user->notify(new DownloadPhotosNotification());
    }
}
