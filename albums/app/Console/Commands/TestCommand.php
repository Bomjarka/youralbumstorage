<?php

namespace App\Console\Commands;


use App\Models\Role;
use App\Models\User;
use App\Notifications\DownloadPhotosNotification;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';

    public function handle()
    {
    }
}
