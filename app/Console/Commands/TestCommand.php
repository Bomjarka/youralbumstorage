<?php

namespace App\Console\Commands;

use App\Http\Requests\RegisterUserRequest;
use Faker\Generator as Faker;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';


    public function handle(Faker $faker)
    {
       dd($faker->userName());


    }



}
