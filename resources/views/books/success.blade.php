@extends('welcome')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Creación de libro exitosa</h2>
                </div>

                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        <p class="lead">El libro se ha creado exitosamente.</p>
                    </div>
                </div>
                
                <div class="card-footer">
                    <a href="{{ route('books.index') }}" class="btn btn-primary btn-lg float-right">Ver libros</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
