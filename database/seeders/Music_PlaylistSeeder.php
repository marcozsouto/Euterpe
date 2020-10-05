<?php

namespace Database\Seeders;

use App\Models\Music;
use App\Models\Playlist;
use Illuminate\Database\Seeder;

class Music_PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $playlist = Playlist::all();
        
        Music::all()->each(function ($music) use ($playlist) { 
            $music->playlist()->attach($playlist->random(rand(1, 2))->pluck('id')->toArray()); 
        });
    }
}
