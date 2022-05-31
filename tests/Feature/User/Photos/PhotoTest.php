<?php

namespace Tests\Feature\User\Photos;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    //страница без фото
    public function test_user_view_empty_photos_page()
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($user);
        $response = $this->get('/photos');

        $response->assertViewHas('photos');
        $response->assertStatus(200);
    }

    //страница со всеми фото
    public function test_user_view_photos_page()
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $photo = Photo::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);
        $response = $this->get('/photos');
        $data = $response->getOriginalContent()->getData();

        $this->assertEquals($data['photos'][0]['id'], $photo->id);
        $response->assertViewHas('photos', $data['photos']);
        $response->assertStatus(200);
    }

    public function test_user_can_create_photo()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $userPhotos = Photo::whereUserId($user->id)->first();
dd($userPhotos);
        $this->assertNull($userPhotos);
        $data = [
            'user_id' => $user->id,
            'photo_name' => 'Test create photo name',
            'photo_description' => 'Test create photo description',
            '_token' => csrf_token(),
        ];

        $this->actingAs($user);

        $response = $this->post('/photos/create', $data);
        $userPhotos = Photo::whereUserId($user->id)->first();

        $this->assertNotNull($userPhotos);
        $response->assertStatus(302);
    }
}
