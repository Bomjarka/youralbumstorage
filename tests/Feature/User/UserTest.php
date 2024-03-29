<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * Пользователь может просматривать главную
     *
     */
    public function test_user_view_home(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($user);
        $response = $this->get('/');

        $response->assertViewHas('user', $user);
        $response->assertStatus(200);
    }

    /**
     * Пользователь может просматривать about
     *
     */
    public function test_user_view_about(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($user);
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    /**
     * Пользователь может просматривать профиль
     *
     */
    public function test_user_view_profile(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $this->actingAs($user);

        $response = $this->get('/profile');

        $response->assertViewHas('user', $user);
        $response->assertStatus(200);
    }

    /**
     * Пользователь может отправлять обратную связь
     *
     */
    public function test_user_can_send_feedback(): void
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

    /**
     * Пользователь без роли не может просматривать админку
     *
     */
    public function test_user_can_not_view_admin(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $this->actingAs($user);

        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    /**
     * @return void
     */
    public function test_user_can_edit_profile_data(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $data = [
            'userId' => $user->id,
            'login' => 'New login',
            'firstName' => 'New name',
            'secondName' => 'New second name',
            'lastName' => 'New last name',
            'email' => 'new@mail.ru',
            'phone' => '81234567891',
            'gender' => 'male',
            'birthdate' => $user->birthdate,
        ];

        $this->actingAs($user);

        $response = $this->post('/profile/edit', $data);
        $user->refresh();

        $this->assertEquals($user->login, $data['login']);
        $this->assertEquals($user->first_name, $data['firstName']);
        $this->assertEquals($user->second_name, $data['secondName']);
        $this->assertEquals($user->last_name, $data['lastName']);
        $this->assertEquals($user->email, $data['email']);
        $this->assertEquals($user->phone, $data['phone']);
        $response->assertJson(['msg' => 'User data updated!']);
        $response->assertStatus(200);

    }


}
