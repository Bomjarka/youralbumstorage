<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\AlbumPhotos;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function test_user_view_home()
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($user);
        $response = $this->get('/');

        $response->assertViewHas('user', $user);
        $response->assertStatus(200);
    }





    public function test_user_view_about()
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($user);
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function test_user_view_profile()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $this->actingAs($user);

        $response = $this->get('/profile');

        $response->assertViewHas('user', $user);
        $response->assertStatus(200);
    }




    public function test_user_can_send_feedback()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $data = [
            'name' => $user->fullName(),
            'email' => $user->email,
            'message' => 'Message from user . ' . $user->id . ' !',
        ];

        $this->actingAs($user);
        $response = $this->post('/feedback', $data);

        $response->assertStatus(302);
    }


}
