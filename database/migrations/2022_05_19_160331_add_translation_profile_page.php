<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationProfilePage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'view-profilepage-profile',
            'key' => 'title',
            'text' => ['ru' => 'На этой странице вы можете настроить свой профиль', 'en' => 'Here you can set up your profile!'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile',
            'key' => 'profile-data',
            'text' => ['ru' => 'Данные профиля', 'en' => 'Profile data'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile',
            'key' => 'login',
            'text' => ['ru' => 'Логин', 'en' => 'Login'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile',
            'key' => 'firstname',
            'text' => ['ru' => 'Имя', 'en' => 'First Name'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile',
            'key' => 'secondname',
            'text' => ['ru' => 'Отчество', 'en' => 'Second Name'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile',
            'key' => 'lastname',
            'text' => ['ru' => 'Фамилия', 'en' => 'Last Name'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile',
            'key' => 'registered',
            'text' => ['ru' => 'Дата регистрации', 'en' => 'Registered'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile',
            'key' => 'sex',
            'text' => ['ru' => 'Пол', 'en' => 'Gender'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile',
            'key' => 'phone',
            'text' => ['ru' => 'Телефон', 'en' => 'Phone'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile',
            'key' => 'email',
            'text' => ['ru' => 'Почта', 'en' => 'Email'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile',
            'key' => 'birthdate',
            'text' => ['ru' => 'Дата рождения', 'en' => 'Birthdate'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile-button',
            'key' => 'edit',
            'text' => ['ru' => 'Редактировать', 'en' => 'Edit'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile-button',
            'key' => 'cancel',
            'text' => ['ru' => 'Отменить', 'en' => 'Cancel'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-profile-button',
            'key' => 'save',
            'text' => ['ru' => 'Сохранить', 'en' => 'Save'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-and-photos',
            'key' => 'albums-and-photos',
            'text' => ['ru' => 'Альбомы & Фотографии', 'en' => 'Albums & Photos'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-and-photos',
            'key' => 'total-albums',
            'text' => ['ru' => 'Всего альбомов', 'en' => 'Total albums'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-and-photos',
            'key' => 'total-photos',
            'text' => ['ru' => 'Всего фотографий', 'en' => 'Total photos'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-and-photos',
            'key' => 'albums',
            'text' => ['ru' => 'Альбомы', 'en' => 'Albums'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-and-photos',
            'key' => 'photos',
            'text' => ['ru' => 'Фотографии', 'en' => 'Photos'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-and-photos',
            'key' => 'no-albums',
            'text' => ['ru' => 'Альбомов нет', 'en' => 'No albums'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-and-photos',
            'key' => 'no-photos',
            'text' => ['ru' => 'Фотографий нет', 'en' => 'No photos'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-and-photos',
            'key' => 'photos',
            'text' => ['ru' => 'Фотографии', 'en' => 'Photos'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-and-photos',
            'key' => 'download-photos',
            'text' => ['ru' => 'Скачать все фотографии', 'en' => 'Download all photos'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-trash',
            'key' => 'trash',
            'text' => ['ru' => 'Корзина', 'en' => 'Trash'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-trash',
            'key' => 'deleted-albums',
            'text' => ['ru' => 'Удалённые альбомы', 'en' => 'Deleted albums'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-trash',
            'key' => 'deleted-photos',
            'text' => ['ru' => 'Удалённые фотографии', 'en' => 'Deleted photos'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-trash',
            'key' => 'no-deleted-albums',
            'text' => ['ru' => 'Нет удалённых альбомов', 'en' => 'No eleted albums'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-trash',
            'key' => 'no-deleted-photos',
            'text' => ['ru' => 'Нет удалённых фотографий', 'en' => 'No deleted photos'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-albums-trash-button',
            'key' => 'restore',
            'text' => ['ru' => 'Восстановить', 'en' => 'Restore'],
        ]);

        LanguageLine::create([
            'group' => 'view-profilepage-premium',
            'key' => 'premium',
            'text' => ['ru' => 'Премиум', 'en' => 'Premium'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
