<?php

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Playlist::factory()->count(5)->create();
        #Playlist::factory()->count(5)->for(User::factory()->count(5))->create();
    }
}
