<?php

namespace App\Console\Commands;


use App\Models\Photo;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\TranslationLoader\LanguageLine;
use ZipArchive;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';

    public function handle(RoleService $roleService)
    {

    }
}
