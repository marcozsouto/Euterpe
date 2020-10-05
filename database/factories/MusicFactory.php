<?php

namespace Database\Factories;
use App\Models\Album;
use App\Models\Music;
use Illuminate\Database\Eloquent\Factories\Factory;
use PhpParser\Node\Expr\Print_;

class MusicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Music::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $albumIds = Album::all()->pluck('id')->toArray();
        $id = $this->faker->randomElement($albumIds);
        $num = Album::find($id);

        return [
            'name' => $this->faker->text($maxNbChars = 256),
            'time' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'music' => $this->faker->file($sourceDir = 'C:/Users/Marcos/Music',  $targetDir ='C:/Users/Marcos/Projetos/Euterpe/Musics'),
            'description' => $this->faker->text($maxNbChars = 256),
            'trackNumber' => $this->faker->numberBetween($min = 1, $max = $num->numberOfTracks),
            'streams' => $this->faker->randomDigit,
            'album_id' => $id
        ];
    }
}
