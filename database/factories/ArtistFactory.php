<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Artist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text($maxNbChars = 256),
            'musicGender' => $this->faker->randomElement($array = array ('pop', 'rap', 'folk', 'k-pop','rock','country','r&b','jazz',' EDM')),
            'icon' => $this->faker->imageUrl($width = 640, $height = 640),
            'cover' => $this->faker->imageUrl($width = 640, $height = 640),
            'followers' => $this->faker->randomDigit
        ];
    }
}
