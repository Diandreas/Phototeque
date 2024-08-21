<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Photothèque</h1>
        <div class="row">
            @foreach($images as $image)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset($image->path) }}" class="card-img-top" alt="{{ $image->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $image->name }}</h5>
                            <p class="card-text">{{ $image->description }}</p>
                            <a href="{{ route('images.show', $image->id) }}" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
