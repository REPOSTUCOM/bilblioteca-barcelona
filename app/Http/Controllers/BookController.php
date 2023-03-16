<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            DB::commit();
        } catch (\Exception$e) {
            DB::rollback();
            return response()->json(['message' => 'Error al guardar el libro'], 500);
        }

        // Devuelve una respuesta con el código de estado 200 y un mensaje de éxito
        return redirect()->route('success');
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
                'published_date' => $request->input('published_date'),
            ]);

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
