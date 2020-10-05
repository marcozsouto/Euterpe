<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Music;
use Illuminate\Database\Seeder;

class Artist_MusicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artist = Artist::all();
        
        Music::all()->each(function ($music) use ($artist) { 
            $music->artist()->attach($artist->random(rand(1,1))->pluck('id')->toArray()); 
        });
    }
}
