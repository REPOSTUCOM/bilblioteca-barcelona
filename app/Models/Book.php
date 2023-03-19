<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Book extends Model
{

    use HasFactory;
    protected $fillable = ['title', 'author', 'description' ,'published_date', 'price',];
   
        public function generateISBN()
        {
            $isbn = '978'; // El prefijo 978 es el utilizado para los códigos de barras EAN de libros
            $isbn .= rand(10, 99); // Añade dos dígitos al azar
            $isbn .= time(); // Añade la marca de tiempo actual
            return $isbn;
    }

      //Call to undefined relationship [categories] on model [App\Models\Book].
      public function categories()
      {
          return $this->belongsToMany(Category::class, 'book_category');
      }

      public function bookCategory()
      {
          return $this->belongsToMany(Category::class, 'book_category');
      }

}