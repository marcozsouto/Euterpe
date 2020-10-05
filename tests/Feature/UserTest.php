<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\Music;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    
     public function validAlbum(){
        $album = Album::factory()->make(); 
        $album->icon =  UploadedFile::fake()->image('test.jpg', 640, 640)->size(100);

        for($i=0;$i< $album->numberOfTracks; $i++){
            $music = Music::factory()->make();
            $music->music =  UploadedFile::fake()->image('test.jpg', 640, 640)->size(100);
            $musics[$i] = $music;
        }
        $album->music($musics);
        return $album;
    }

    public function testUserNotLoggedAcessAlbumForm()
    {
        $response = $this->get('/euterpe/album/new');

        $response->assertStatus(403);
    }

    public function testUserNotEuterpedAcessAlbumForm()
    {
        $user = User::where('username', '!=', 'euterpe')->first();
        $response = $this->actingAs($user)->get('/euterpe/album/new');

        $response->assertStatus(403);
    }

    public function testUserEuterpedAcessAlbumForm()
    {
        $user = User::where('username', '=', 'euterpe')->first();
        $response = $this->actingAs($user)->get('/euterpe/album/new');

        $response->assertStatus(200);
    }

    public function testUserNotEuterpedSendAlbumForm()
    {
        $user = User::where('username', '!=', 'euterpe')->first();
        $data = $this->validAlbum();
        //$this->withoutMiddleware();
        $response = $this->actingAs($user)->post('/euterpe/album/new', $data->toArray());

        $response->assertStatus(403);
    }

    public function testUserEuterpeSendAlbumFormIncompleated(){
        $user = User::where('username', 'euterpe')->first();
        $data = $this->validAlbum();
        $data->name = "";
        $this->withoutMiddleware();
        $response = $this->actingAs($user)->post('/euterpe/album/new', $data->toArray());
        $response->assertStatus(302);
        $response->assertRedirect('/euterpe/album/new');
        $response->assertSessionHas('errors');
    }

}
