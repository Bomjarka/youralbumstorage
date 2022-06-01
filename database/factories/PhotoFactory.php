<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigitNotZero(),
            'name' => 'test photo name',
            'description' => 'test photo description',
            'photo_path' => 'path',
            'photo_preview_path' => 'preview_path',
            'deleted_at' => null,
        ];
    }
}
