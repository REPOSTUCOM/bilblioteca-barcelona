<?php

namespace Database\Seeders;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Obtener los id's de todos los libros

class BooksCategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookIds = DB::table('books')->pluck('id')->toArray(); foreach ($bookIds as $bookId) { // Generar un número aleatorio entre 1 y 3
            $randomCategoriesCount = random_int(1, 3);  // Obtener los id's de categorías aleatorias
            $categoryIds = DB::table('categories')->inRandomOrder()->limit($randomCategoriesCount)->pluck('id')->toArray(); // Insertar las relaciones en la tabla intermedia
            foreach ($categoryIds as $categoryId) {
            DB::table('book_category')->insert([
            'book_id' => $bookId,
            'category_id' => $categoryId,
            'created_at' => now(),
            'updated_at' => now()
                 ]);
            }
            }
    }
}
