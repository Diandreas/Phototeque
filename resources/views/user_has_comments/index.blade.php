<!-- resources/views/user_has_comments/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestion des associations entre utilisateurs et commentaires</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Commentaire</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userHasComments as $association)
                <tr>
                    <td>{{ $association->user->name }}</td>
                    <td>{{ $association->comment->description }}</td>
                    <td>
                        <form action="{{ route('user_has_comments.destroy', $association->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('user_has_comments.create') }}" class="btn btn-primary">Ajouter une association</a>
    </div>
@endsection
