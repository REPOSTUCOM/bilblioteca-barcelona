@extends('welcome')

@section('content')
    <div class="container mt-4">
        <h1>Editar libro</h1>
        <hr>
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}">
            </div>
            <div class="form-group">
                <label for="author">Autor:</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}">
            </div>
            <div class="form-group">
                <label for="published_date">Fecha de publicación:</label>
                <input type="date" class="form-control" id="published_date" name="published_date" value="{{ $book->published_date }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
