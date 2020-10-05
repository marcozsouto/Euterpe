<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [                
            'name' => $this->faker->name,
            'username' => $this->faker->userName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'gender' => $this->faker->randomElement($array = array ('M','F','N')),
            'birth' => $this->faker->date($format = 'Y-m-d', $max = '-18 years') ,
            'icon' => $this->faker->imageUrl($width = 640, $height = 640)
        ];
    }
}
