@extends('welcome')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Lista de libros</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <a href="{{ route('books.create') }}" class="btn btn-success">Crear libro</a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">Filtrar por categoría</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.index') }}" method="GET">
                        <div class="form-group mb-3">
                            <label for="category" class="form-label visually-hidden">Categoría</label>
                            <select id="category" name="category" class="form-select form-control">
                                <option value="">Todas las categorías</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $selected_category ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Fecha de Publicación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->published_date }}</td>
                        <td class="text-center">
                            <a href="{{ route('books.edit', ['id' => $book->id]) }}" class="btn btn-primary me-2">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('books.destroy', ['id' => $book->id]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger me-2">
                                    <i class="bi bi-trash"></i> Borrar
                                </button>
                            </form>
                            <a href="{{ route('books.show', ['id' => $book->id]) }}" class="btn btn-secondary">
                                <i class="bi bi-eye"></i> Mostrar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection