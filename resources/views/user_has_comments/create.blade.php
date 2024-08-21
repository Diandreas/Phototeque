<!-- resources/views/user_has_comments/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ajouter une nouvelle association entre utilisateur et commentaire</h1>
        <form action="{{ route('user_has_comments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Utilisateur</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="comment_id">Commentaire</label>
                <select class="form-control" id="comment_id" name="comment_id" required>
                    @foreach($comments as $comment)
                        <option value="{{ $comment->id }}">{{ $comment->description }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
