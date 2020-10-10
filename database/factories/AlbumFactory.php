<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlbumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Album::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $artistIds = Artist::all()->pluck('id')->toArray();
        return [
            'name' => $this->faker->text($maxNbChars = 45),
            'description' => $this->faker->text($maxNbChars = 256),
            'icon' => $this->faker->imageUrl($width = 640, $height = 640),
            'numberOfTracks' => $this->faker->randomDigitNotNull,
            'gender' => $this->faker->randomElement($array = array ('pop', 'rap', 'folk', 'k-pop','rock','country','r&b','jazz',' EDM')),
            'releaseDate' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'artist_id' => $this->faker->randomElement($artistIds)
        ];
    }
}
