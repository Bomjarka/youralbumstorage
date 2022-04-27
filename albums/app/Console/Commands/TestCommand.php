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

        $startDate = Carbon::now()->startOfDay()->subMonths(2)->format('F');
        $endDate = Carbon::now()->startOfDay()->format('F');
        $period = CarbonPeriod::create($startDate, $endDate);
        $registeredCount = [];
        foreach ($period as $date) {
            $registeredCount[$date->format('F')] = User::where(DB::raw("extract(month from created_at)"), '=', $date->format('m'))->count();
        }
        dd($registeredCount);

//        dd(json_encode($rolesArr));
    }
}
