<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'publication_year' => 2008,
                'genre' => 'Programming',
                'library_id' => 1, // Thư viện IT Đại học ABC
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'author' => 'Andrew Hunt',
                'publication_year' => 1999,
                'genre' => 'Programming',
                'library_id' => 1, // Thư viện IT Đại học ABC
            ],
            [
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen',
                'publication_year' => 2009,
                'genre' => 'Computer Science',
                'library_id' => 2, // Thư viện Khoa học Tự nhiên
            ],
        ]);
    }
}
