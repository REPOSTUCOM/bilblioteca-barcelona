@extends('welcome')

@section('content')
<h1>Lista de libros</h1>
<a href="{{ route('books.create')}}" class="btn btn-primary mb-3">Crear libro</a>
<table class="table">
    <thead>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Editorial</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->published_date }}</td>
            <td><a href="{{ route('books.edit', ['id' => $book->id]) }}" class="btn btn-primary">Editar</a></td>
            <td>
                <form action="{{ route('books.destroy', ['id' => $book->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection