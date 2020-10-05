<?php

namespace Database\Seeders;

use App\Models\Music;
use App\Models\Album;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MusicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num = Album::all()->pluck('numberOfTracks')->sum();
        Music::factory()->count($num)->create();
    }
}
