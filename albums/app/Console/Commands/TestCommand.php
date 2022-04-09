<?php

namespace App\Console\Commands;


use App\Helpers\RoleHelper;
use App\Models\User;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';

    public function handle()
    {

        $user = User::find(1);

        dd(RoleHelper::has_role('admin', $user->id));

    }
}
