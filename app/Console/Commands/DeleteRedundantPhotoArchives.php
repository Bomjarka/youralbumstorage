<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
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
        $usersQuery = User::whereExists(static function (Builder $query) {
            $query->from('photos')->whereRaw('user_id = users.id');
        });

        $deletedArchives = [];
        Log::info('Start deleting users archives, total users: ' . $usersQuery->count());

        foreach ($usersQuery->cursor() as $user) {
            if ($user->photos->count() != 0) {
                $userArchivePath = 'userphotos/' . $user->id . '/photos.zip';
                if (!Storage::disk('public')->exists($userArchivePath)) {
                    continue;
                }
                $fileCreated = Storage::disk('public')->lastModified($userArchivePath);

                if (Carbon::createFromTimestamp($fileCreated) > Carbon::now()->subMinutes(1)) {
                    continue;
                }

                $deletedArchives += ['user' => $user->id];

                Storage::disk('public')->delete($userArchivePath);
            }
        }

        Log::info('Deleting archives finished, total count: ' . count($deletedArchives));
    }
}
