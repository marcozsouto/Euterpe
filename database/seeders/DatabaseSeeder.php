<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ArtistSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AlbumSeeder::class);
        $this->call(MusicSeeder::class);
        $this->call(PlaylistSeeder::class);
        $this->call(Album_UserSeeder::class);
        $this->call(Artist_MusicSeeder::class);
        $this->call(Artist_UserSeeder::class);
        $this->call(Music_PlaylistSeeder::class);
    }
}
