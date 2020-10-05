<?php

namespace Tests\Unit;

use App\Models\Album;
use App\Models\User;
use App\Validators\AlbumValidator;
use App\Validators\UserValidator;
use App\Validators\ValidationException;
use Illuminate\Http\Request;
use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageServiceProvider;
use Intervention\Image\ImageManager;
use Image;
use Illuminate\Support\Str;
class AlbumTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCorrectAlbum(){
        $album = Album::factory()->make();
        $album->icon =  UploadedFile::fake()->image('test.jpg', 640, 640)->size(100);
        AlbumValidator::validate($album->toArray());
        $this->assertTrue(true);
    }
    
    public function testNameNull(){
        $this->expectException(ValidationException::class);
        $album = Album::factory()->make();
        $album->name = "";
        $album->icon =  UploadedFile::fake()->image('test.jpg', 640, 640)->size(100);
        AlbumValidator::validate($album->toArray());
    }
    
    public function testImageDimensionsWrong(){
        $this->expectException(ValidationException::class);
        $album = Album::factory()->make();
        $album->icon =  UploadedFile::fake()->image('test.jpg', 750, 640)->size(100);
        AlbumValidator::validate($album->toArray());
    }

    public function testdescriptionSize(){
        $this->expectException(ValidationException::class);
        $album = Album::factory()->make();
        $album->description = Str::random(257);
        $album->icon =  UploadedFile::fake()->image('test.png', 640, 640)->size(100);
        AlbumValidator::validate($album->toArray());
    }

    public function testImageExtensionWrong(){
        $this->expectException(ValidationException::class);
        $album = Album::factory()->make();
        $album->name = "";
        $album->icon =  UploadedFile::fake()->image('test.jpg', 750, 640)->size(100);
        AlbumValidator::validate($album->toArray());

    }
     
}
