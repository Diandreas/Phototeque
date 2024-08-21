@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top" alt="{{ $image->name }}">
                    <div class="card-body">
                        <h1 class="card-title">{{ $image->name }}</h1>
                        <p class="card-text">{{ $image->description }}</p>

                        <h2 class="mt-4">Commentaires</h2>
                        <ul class="list-group">
                            @foreach($image->comments as $comment)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">
                                            @if ($comment->user)
                                                {{ $comment->user->name }}
                                            @else
                                                Utilisateur supprimé
                                            @endif
                                        </div>
                                        {{ $comment->description }}
                                    </div>
                                    <div>
                                        @if (auth()->user() && auth()->user()->comments()->where('id', $comment->id)->exists())
                                            <form action="{{ route('user-comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                            </form>
                                        @endif
                                        <span class="badge bg-primary rounded-pill">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <h2 class="mt-4">Ajouter un commentaire</h2>
                        <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                            @csrf
                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <div class="form-group">
                                <label for="description">Commentaire</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('images.download', $image->id) }}" class="btn btn-outline-primary me-2">Télécharger</a>
                            <a href="{{ route('images.edit', $image->id) }}" class="btn btn-primary">Modifier</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
