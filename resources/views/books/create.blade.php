@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Crear libro</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('books.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Título</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="author" class="col-md-4 col-form-label text-md-right">Autor</label>

                                <div class="col-md-6">
                                    <input id="author" type="text" class="form-control" name="author" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="published_date" class="col-md-4 col-form-label text-md-right">Fecha de publicación</label>

                                <div class="col-md-6">
                                    <input id="published_date" type="date" class="form-control" name="published_date" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Crear
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
