<!-- resources/views/roles/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le rôle</h1>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom du rôle</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
