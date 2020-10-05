<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Database\Seeder;

class Artist_UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all();
        
        Artist::all()->each(function ($artist) use ($user) { 
            $artist->user()->attach($user->random(rand(1, 3))->pluck('id')->toArray()); 
        });
    }
}
