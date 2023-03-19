@extends('welcome')

@section('content')
<h1>Crear nuevo libro</h1>
<form method="POST" action="{{ route('books.store') }}">
    @csrf
    <div class="form-group">
        <label for="title">Título</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required autofocus>
        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="author">Autor</label>
        <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}" required>
        @error('author')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="category">Categoría</label>
        <select name="category[]" id="category" class="form-control" multiple>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="description">Descripción</label>
        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">Precio</label>
        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" min="0" step="0.01"
            required>
        @error('price')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="published_date">Fecha de Publicación:</label>
        <input type="date" name="published_date" class="form-control" value="{{ old('published_date') }}" />
        @error('published_date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Crear libro</button>
</form>
@endsection