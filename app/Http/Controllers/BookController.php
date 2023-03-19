<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $selected_category = $request->input('category');
    $categories = Category::all();
    $books = Book::with('categories')->orderBy('title', 'asc');

    if ($selected_category) {
        $books = $books->whereHas('categories', function ($query) use ($selected_category) {
            $query->where('category_id', $selected_category);
        });
    }

    $books = $books->get();

    return view('books.index', compact('books', 'categories', 'selected_category'));
}
    
    
        
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create',compact('categories'));
    }
    public function store(Request $request)
{
    // Define las reglas de validación para los datos del libro
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
    ]);

    // Crea un nuevo objeto Book y asigna los valores de los datos proporcionados en la solicitud
    $book = Book::create([
        'title' => $request->input('title'),
        'author' => $request->input('author'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'published_date' => $request->input('published_date'),
    ]);

    // Guarda el libro en la base de datos
    DB::beginTransaction();
    try {
        $book->save();
        $categories = $request->input('categories');
        $book->categories()->attach($request->input('category'));
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['message' => 'Error al guardar el libro'], 500);
    }

    // Devuelve una respuesta con el código de estado 200 y un mensaje de éxito
    return redirect()->route('success');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::with('categories')->findOrFail($id);
        $categories = Category::all();
    
        $selectedCategoryIds = $book->categories->pluck('id')->toArray(); // Arreglo de IDs de categorías seleccionadas
    
        return view('books.edit', compact('book', 'categories', 'selectedCategoryIds'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
    
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->price = $request->input('price');
        $book->published_date = $request->input('published_date');
    
        // Actualizar la relación many-to-many en la tabla intermedia book_category
        $categories = $request->input('categories');
        $book->categories()->sync($categories);
    
        $book->save();
    
        return redirect()->route('books.index')->with('success', 'Libro actualizado correctamente');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('books.index')->with('error', 'El libro no existe');
        }

        // Eliminar los registros relacionados en la tabla `book_category`
        DB::table('book_category')->where('book_id', $id)->delete();

        // Eliminar el registro en la tabla `books`
        DB::table('books')->where('id', $id)->delete();

        return redirect()->route('books.index')->with('success', 'El libro ha sido eliminado');
    }

}