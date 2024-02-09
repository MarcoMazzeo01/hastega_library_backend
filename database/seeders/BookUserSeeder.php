<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Log;

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
            $randomBooks = $faker->randomElements($books, random_int(1, 5), false);
            Log::alert($randomBooks);
            $user->books()->attach($randomBooks,  ['created_at' => now()]);

            foreach ($randomBooks as $bookId) {
                $book = Book::where('id', $bookId);
                $book->increment('reads', 1);
            }
        }
    }
}
