<?php

namespace Database\Seeders;

use App\Models\Artist;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artist::factory()->count(5)->create();
        
    }
}
