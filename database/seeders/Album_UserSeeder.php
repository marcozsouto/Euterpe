<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Seeder;

class Album_UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all();
        
        Album::all()->each(function ($album) use ($user) { 
            $album->user()->attach($user->random(rand(1, 3))->pluck('id')->toArray()); 
        });
    }
}