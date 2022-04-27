<?php

namespace App\Console\Commands;


use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';

    public function handle()
    {
//        User::factory()->count(5)->create();

        dd(User::find(7)->isBlocked());

//        dd(json_encode($rolesArr));
    }
}
