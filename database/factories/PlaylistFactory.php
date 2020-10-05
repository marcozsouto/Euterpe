<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaylistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Playlist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = User::all()->pluck('id')->toArray();
        return [
            'name' => $this->faker->text($maxNbChars = 45),
            'description' => $this->faker->text($maxNbChars = 256),
            'icon' => $this->faker->imageUrl($width = 640, $height = 640),
            'view' => $this->faker->randomDigitNotNull,
            'user_id' => $this->faker->randomElement($userIds)
    
        ];
    }
}
