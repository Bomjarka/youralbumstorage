<?php

namespace App\Console\Commands;


use App\Models\User;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';

    public function handle()
    {
        $user = User::find(1);
        dd($user->unreadNotifications()->count());
    }
}
