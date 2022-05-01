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
        $photos = User::find(2)->photos;
        dd($photos->where('id', '>', $photos->first()->id)->count());
    }
}
