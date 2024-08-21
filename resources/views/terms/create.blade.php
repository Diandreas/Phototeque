<!-- resources/views/terms/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ajouter un nouveau terme</h1>
        <form action="{{ route('terms.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom du terme</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
