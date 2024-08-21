<!-- resources/views/term_has_images/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ajouter une nouvelle association entre terme et image</h1>
        <form action="{{ route('term_has_images.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="term_id">Terme</label>
                <select class="form-control" id="term_id" name="term_id" required>
                    @foreach($terms as $term)
                        <option value="{{ $term->id }}">{{ $term->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image_id">Image</label>
                <select class="form-control" id="image_id" name="image_id" required>
                    @foreach($images as $image)
                        <option value="{{ $image->id }}">{{ $image->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
