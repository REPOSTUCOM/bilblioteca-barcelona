<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $table = 'book_category';
    protected $fillable = ['book_id', 'category_id'];
    
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}