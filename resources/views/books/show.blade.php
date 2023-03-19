@extends('welcome')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <h1 class="card-title text-center">{{ $book->title }}</h1>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-subtitle mb-2 text-muted">Author:</h5>
                            <p class="card-text">{{ $book->author }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-subtitle mb-2 text-muted">Description:</h5>
                            <p class="card-text">{{ $book->description}}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-subtitle mb-2 text-muted">Price:</h5>
                            <p class="card-text">{{ $book->price}}</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5 class="card-subtitle mb-2 text-muted">ISBN:</h5>
                            <p class="card-text">{{ $book->ISBN }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-subtitle mb-2 text-muted">Published Date:</h5>
                            <p class="card-text">{{ $book->published_date }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('books.edit', ['id' => $book->id]) }}"
                        class="btn btn-outline-primary mr-3">Editar</a>
                    <form action="{{ route('books.destroy', ['id' => $book->id]) }}" method="POST"
                        class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Borrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    border-radius: 15px;
    border: 1px solid #e9e9e9;
}

.card-title {
    font-size: 3rem;
    font-weight: bold;
    color: #2d3748;
}

.card-subtitle {
    font-weight: bold;
}

.card-text {
    font-size: 1.2rem;
    color: #718096;
}

.btn {
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-outline-primary {
    border-color: #3490dc;
    color: #3490dc;
}

.btn-outline-primary:hover {
    background-color: #3490dc;
    color: #fff;
}

.btn-outline-danger {
    border-color: #e3342f;
    color: #e3342f;
}

.btn-outline-danger:hover {
    background-color: #e3342f;
    color: #fff;
}
</style>
@endpush