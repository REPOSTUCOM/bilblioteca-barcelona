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
            <input type="date" class="form-control" id="published_date" name="published_date"
                value="{{ $book->published_date }}">
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description"
                rows="3">{{ $book->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Precio:</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $book->price }}">
        </div>
        <div class="form-group">
            <label for="category_id">Categoría:</label>
            <select name="categories[]" class="form-control" multiple>
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ in_array($category->id, $selectedCategoryIds) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection