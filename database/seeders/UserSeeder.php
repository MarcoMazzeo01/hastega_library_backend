<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Log;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)

    {
        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->first_name = $faker->firstName();
            $user->last_name = $faker->lastName();
            $user->email = $faker->unique()->safeEmail();
            $user->save();
        }
    }
}
