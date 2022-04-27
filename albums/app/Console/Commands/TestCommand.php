<?php

namespace App\Console\Commands;


use App\Models\User;
use App\Services\RoleService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';

    public function handle()
    {
        $user = User::find(2);

        $rolesArr = [];
        foreach ((new RoleService())->getAllRoles() as $role) {
            $rolesArr[] = $role->name;
        }
        dd(json_encode($rolesArr));
    }
}
