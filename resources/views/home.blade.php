@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-12">
                <h1 class="text-center mb-4">Photothèque</h1>
                <p class="text-center mb-4">Découvrez notre riche collection d'images et interagissez avec notre communauté.</p>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control me-2" placeholder="Rechercher des images" aria-label="Rechercher">
                        <button class="btn btn-primary">Rechercher</button>
                    </div>
                    <div>
                        <button class="btn btn-outline-primary me-2">Ajouter une image</button>
                        <a href="{{ route('images.create') }}" class="btn btn-primary">Ajouter une image</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($images as $image)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top" alt="{{ $image->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $image->name }}</h5>
                            <p class="card-text">{{ $image->description }}</p>
                            <div class="d-flex justify-content-between mt-auto">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-heart me-1"></i>
                                    <span>{{ $image->likes_count }}</span>
                                    <i class="bi bi-chat ms-3 me-1"></i>
                                    <span>{{ $image->comments_count }}</span>
                                </div>
                                <div>
                                    <a href="{{ route('images.show', $image->id) }}" class="btn btn-primary btn-sm">Voir plus</a>
                                    <a href="{{ route('images.download', $image->id) }}" class="btn btn-outline-primary btn-sm">Télécharger</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
{{--        <nav aria-label="Page navigation">--}}
{{--            <ul class="pagination justify-content-center">--}}
{{--                <li class="page-item {{ $images->currentPage() == 1 ? 'disabled' : '' }}">--}}
{{--                    <a class="page-link" href="{{ $images->previousPageUrl() }}" aria-label="Previous">--}}
{{--                        <span aria-hidden="true">&laquo;</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @for($i = 1; $i <= $images->lastPage(); $i++)--}}
{{--                    <li class="page-item {{ $images->currentPage() == $i ? 'active' : '' }}">--}}
{{--                        <a class="page-link" href="{{ $images->url($i) }}">{{ $i }}</a>--}}
{{--                    </li>--}}
{{--                @endfor--}}
{{--                <li class="page-item {{ $images->currentPage() == $images->lastPage() ? 'disabled' : '' }}">--}}
{{--                    <a class="page-link" href="{{ $images->nextPageUrl() }}" aria-label="Next">--}}
{{--                        <span aria-hidden="true">&raquo;</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </nav>--}}
    </div>
@endsection
