<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->create([
            'name' => "Euterpe", 
            'username' =>"euterpe" ,
            'email' =>"euterpe@gmail.com",
            'password'=>Hash::make('123456'),
            'gender'=>'M',
            'birth'=>'2001-04-04',
            'icon'=> 'public/storage/admin.jpg'
        ]);
        
    }
}
