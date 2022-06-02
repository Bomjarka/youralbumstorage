<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class GuestTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function test_guset_view_home()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_guset_view_albums()
    {
        $response = $this->get('/albums');

        $response->assertStatus(200);
    }

    public function test_guset_view_about()
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function test_guset_view_photos()
    {
        $response = $this->get('/photos');

        $response->assertStatus(200);
    }

    public function test_guset_view_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_guset_view_register()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_guest_view_forgot_password()
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_guest_change_locale_to_en()
    {
        $ruLocale = App::getLocale();
        $response = $this->get('/locale/en');

        $this->assertNotEquals($ruLocale, App::getLocale());
        $response->assertStatus(302);
    }

    public function test_guest_change_locale_to_ru()
    {
        App::setLocale('en');
        $enLocale = App::getLocale();
        $response = $this->get('/locale/ru');

        $this->assertNotEquals($enLocale, App::getLocale());
        $response->assertStatus(302);
    }

    public function test_guest_can_send_feedback()
    {
        $data = [
            'name' => 'guest',
            'email' => 'guest@gmail.com',
            'message' => 'Message from guest!',
        ];

        $response = $this->withoutMiddleware()->post('/feedback', $data);

        $response->assertStatus(302);
    }
}
