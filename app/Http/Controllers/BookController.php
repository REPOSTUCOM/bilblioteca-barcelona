<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = DB::table('books')->get();
         return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
  /*   public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'published_date' => 'required|date',
        ]);
    
        // Crea un nuevo libro
        DB::beginTransaction();
        try {
            $book = new Book;
            $book->title = $request->title;
            $book->author = $request->author;
            $book->published_date = $request->published_date;
            $book->save();
    
            DB::commit();
    
            return redirect()->route('books.index')->with('success', 'El libro se ha creado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('books.index')->with('error', 'Ha ocurrido un error al crear el libro. Inténtelo de nuevo más tarde.');
        }
    } */
public function store(Request $request)
{
    // Validación de los datos recibidos por el formulario
    $validatedData = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'published_date' => 'required|date',
    ]);

    // Creación de un nuevo objeto libro a partir de los datos validados
    $book = new Book([
        'title' => $validatedData['title'],
        'author' => $validatedData['author'],
        'published_date' => $validatedData['published_date'],
    ]);

    // Guardado del nuevo libro en la base de datos
    $book->save();

    // Redireccionamiento a la página de listado de libros
    return redirect()->route('books.index');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        return view('books.edit', ['book' => $book]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('books')
        ->where('id', $id)
        ->update([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'published_date' => $request->input('published_date')
        ]);

    return redirect()->route('books.index')->with('success', 'Libro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}