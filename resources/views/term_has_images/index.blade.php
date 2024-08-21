<!-- resources/views/term_has_images/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestion des associations entre termes et images</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Terme</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($termHasImages as $association)
                <tr>
                    <td>{{ $association->term->name }}</td>
                    <td>{{ $association->image->name }}</td>
                    <td>
                        <form action="{{ route('term_has_images.destroy', $association->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('term_has_images.create') }}" class="btn btn-primary">Ajouter une association</a>
    </div>
@endsection
