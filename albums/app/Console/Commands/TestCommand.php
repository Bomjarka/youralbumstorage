<?php

namespace App\Console\Commands;


use App\Models\User;
use App\Services\RoleService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';

    public function handle(RoleService $roleService)
    {
        $user = User::find(2);
        dd($user->roles()->count());
    }
}
