<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class BookUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();
        $books = Book::all()->pluck('id')->toArray();

        foreach ($users as $user) {
            $user->books()->attach($faker->randomElements($books, random_int(1, 6)));
        }
    }
}
