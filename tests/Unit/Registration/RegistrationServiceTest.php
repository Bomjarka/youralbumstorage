<?php

namespace Tests\Unit\Registration;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\Registration\RegistrationService;
use App\Services\Registration\UserData;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Arr;
use Tests\TestCase;

class RegistrationServiceTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_service_create_user()
    {
        $data = $this->prepareData();
        $user = (new RegistrationService())->registerUser($data);

        $this->assertEquals(Arr::except($user->toArray(),
            ['is_verified', 'is_blocked', 'updated_at', 'created_at', 'id', 'password']),
            Arr::except($data, ['password']));
        $this->assertNotNull($user);
    }

    /**
     * @return array
     */
    private function prepareData(): array
    {
        $faker = Faker::create();
        $registerUserRequest = new RegisterUserRequest();

        $data = [
            'login' => '13',
            'first_name' => $faker->firstName,
            'second_name' => $faker->name,
            'last_name' => $faker->lastName,
            'email' => $faker->unique()->safeEmail,
            'phone' => '81234567891',
            'gender' => 'male',
            'birthdate' => $faker->date,
            'password' => $faker->password,
        ];
        $registerUserRequest->merge($data);

        $this->assertNull(User::whereLogin($data['login'])
            ->whereOr('email', $data['email'])
            ->whereOr('phone', $data['phone'])
            ->first());

        return UserData::prepareData($registerUserRequest);
    }
}
