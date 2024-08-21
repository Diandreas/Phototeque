<!-- resources/views/terms/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestion des termes</h1>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($terms as $term)
                <tr>
                    <td>{{ $term->id }}</td>
                    <td>{{ $term->name }}</td>
                    <td>
                        <a href="{{ route('terms.edit', $term->id) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('terms.destroy', $term->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('terms.create') }}" class="btn btn-primary">Ajouter un terme</a>
    </div>
@endsection
