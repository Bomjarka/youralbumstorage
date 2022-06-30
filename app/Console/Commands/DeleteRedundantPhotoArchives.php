<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeleteRedundantPhotoArchives extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-redundant-archives';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаляет архивы с фото, которые не были скачаны пользователями';

    /**
     * Идём по всем клиентам у кого есть фото и удаляем архивы
     *
     * @return void
     */
    public function handle()
    {
        $databaseQuery = "SELECT id FROM users
                    WHERE EXISTS(SELECT 1 FROM photos WHERE user_id = users.id AND deleted_at IS NULL)";
        $userIds = Arr::flatten(json_decode(json_encode(DB::select($databaseQuery)), true));
        $deletedArchives = [];
        Log::info('Start deleting users archives, total users: ' . count($userIds));

        foreach ($userIds as $userId) {
            $user = User::find($userId);
            if ($user->photos->count() != 0) {
                $userArchivePath = 'userphotos/' . $user->id . '/photos.zip';
                if (!Storage::disk('public')->exists($userArchivePath)) {
                    continue;
                }
                $fileCreated = Storage::disk('public')->lastModified($userArchivePath);

                if (Carbon::createFromTimestamp($fileCreated) > Carbon::now()->subMinutes(10)) {
                    continue;
                }

                $deletedArchives += ['user' => $user->id];

                Storage::disk('public')->delete($userArchivePath);
            }
        }

        Log::info('Deleting archives finished, total count: ' . count($deletedArchives));
    }
}
