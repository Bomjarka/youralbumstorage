<?php

namespace App\Console\Commands;


use App\Helpers\RoleHelper;
use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';

    public function handle()
    {
        $user = User::find(1);
        $user->notify(new UserRegistered());



    }
}
