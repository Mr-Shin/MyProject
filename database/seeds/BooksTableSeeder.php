<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class,1)->create()->each(function ($user){
            $books=factory(\App\Book::class,10)->create()->each(function ($book){
                $book->categories()->attach(\App\Category::find(1));
            });
            $user->books()->saveMany($books);
        });


    }
}
