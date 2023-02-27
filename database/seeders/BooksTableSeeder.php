<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Illuminate\Support\Facades\Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i <10 ; $i++) { 
            DB::table('books')->insert([
                'ISBN'=>fake()->ean13(),
                'title'=>fake()->sentence(),
                'author'=>fake()->name(),
                'published_date'=>fake()->date(),
                'description'=>fake()->text(),
                'price'=>fake()->numberBetween(20,3000),
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}

