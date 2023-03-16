@extends('welcome')

@section('content')
<div class="container">
  <div class="row justify-content-between mb-4">
    <div class="col-6">
      <h1>Lista de libros</h1>
    </div>
    <div class="col-6 text-right">
      <a href="{{ route('books.create') }}" class="btn btn-success">Crear libro</a>
    </div>
  </div>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Fecha de Publicación</th>
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
</div>
@endsection
