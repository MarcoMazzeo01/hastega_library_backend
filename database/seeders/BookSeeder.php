<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $google_ids = [
            'Zbe8ngEACAAJ', //harry potter 1
            'ng--EAAAQBAJ', //regole dello shangai
            '8_r7wpdqq5kC', //queste oscure materie
        ];

        foreach ($google_ids as $id) {
            $book = new Book();
            $book->google_id = $id;
            $book->save();
        }

        for ($i = 0; $i < 4; $i++) {
            $book = new Book();
            $book->title = $faker->sentence(4, true);
            $book->author = $faker->name();
            $book->isbn = $faker->isbn13();
            $book->plot = $faker->paragraph(3);
            $book->save();
        }
    }
}