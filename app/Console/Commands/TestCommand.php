<?php

namespace App\Console\Commands;


use App\Helpers\RoleHelper;
use App\Models\Permission;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Notifications\DownloadPhotosNotification;
use App\Services\RoleService;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Console\Command;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\TranslationLoader\LanguageLine;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $name = 'TestCommand';


    public function handle(RoleService $roleService)
    {

    }



}
