<!-- resources/views/images/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $image->name }}</h1>
        <img src="{{ asset($image->path) }}" class="img-fluid" alt="{{ $image->name }}">
        <p>{{ $image->description }}</p>

        <h2>Commentaires</h2>
        <ul class="list-group">
            @foreach($image->comments as $comment)
                <li class="list-group-item">
                    {{ $comment->description }}
                </li>
            @endforeach
        </ul>

        <h2>Ajouter un commentaire</h2>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="image_id" value="{{ $image->id }}">
            <div class="form-group">
                <label for="description">Commentaire</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
