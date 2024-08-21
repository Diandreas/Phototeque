<!-- resources/views/terms/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le terme</h1>
        <form action="{{ route('terms.update', $term->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom du terme</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $term->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
