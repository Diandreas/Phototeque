@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Galerie d'images</h1>
        <a href="{{ route('images.create') }}" class="btn btn-primary mb-3">Ajouter une nouvelle image</a>

        <!-- Barre de Recherche -->
        <form action="{{ route('images.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Rechercher des images..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                </div>
            </div>
        </form>

        <div class="row">
            @foreach($images as $image)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top" alt="{{ $image->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $image->name }}</h5>
                            <p class="card-text">{{ $image->description }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('images.show', $image->id) }}" class="btn btn-info">Voir</a>
                                <a href="{{ route('images.edit', $image->id) }}" class="btn btn-primary mx-2">Modifier</a>
                                <form action="{{ route('images.destroy', $image->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                            <div class="mt-2">
                                <strong>Termes :</strong>
                                @foreach($image->terms as $term)
                                    <span class="badge badge-secondary">{{ $term->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
@endsection
