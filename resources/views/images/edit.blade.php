@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5 bg-light">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-header">
                        <h2>Edit Image: {{ $image->name }}</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Image Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $image->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="identification_number" class="form-label">Identification Number</label>
                                <input type="text" name="identification_number" id="identification_number" class="form-control @error('identification_number') is-invalid @enderror" value="{{ old('identification_number', $image->identification_number) }}" required>
                                @error('identification_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="creation_date" class="form-label">Creation Date</label>
                                <input type="date" name="creation_date" id="creation_date" class="form-control @error('creation_date') is-invalid @enderror" value="{{ old('creation_date', $image->creation_date) }}" required>
                                @error('creation_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" name="author" id="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author', $image->author) }}" required>
                                @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="source" class="form-label">Source</label>
                                <input type="text" name="source" id="source" class="form-control @error('source') is-invalid @enderror" value="{{ old('source', $image->source) }}">
                                @error('source')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="support" class="form-label">Support</label>
                                <input type="text" name="support" id="support" class="form-control @error('support') is-invalid @enderror" value="{{ old('support', $image->support) }}">
                                @error('support')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="dimensions" class="form-label">Dimensions</label>
                                <input type="text" name="dimensions" id="dimensions" class="form-control @error('dimensions') is-invalid @enderror" value="{{ old('dimensions', $image->dimensions) }}">
                                @error('dimensions')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $image->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="main_subject" class="form-label">Main Subject</label>
                                <input type="text" name="main_subject" id="main_subject" class="form-control @error('main_subject') is-invalid @enderror" value="{{ old('main_subject', $image->main_subject) }}">
                                @error('main_subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="represented_elements" class="form-label">Represented Elements</label>
                                <textarea name="represented_elements" id="represented_elements" rows="3" class="form-control @error('represented_elements') is-invalid @enderror">{{ old('represented_elements', $image->represented_elements) }}</textarea>
                                @error('represented_elements')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="actions_represented" class="form-label">Actions Represented</label>
                                <textarea name="actions_represented" id="actions_represented" rows="3" class="form-control @error('actions_represented') is-invalid @enderror">{{ old('actions_represented', $image->actions_represented) }}</textarea>
                                @error('actions_represented')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="context" class="form-label">Context</label>
                                <textarea name="context" id="context" rows="3" class="form-control @error('context') is-invalid @enderror">{{ old('context', $image->context) }}</textarea>
                                @error('context')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" name="color" id="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color', $image->color) }}">
                                @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="technique" class="form-label">Technique</label>
                                <input type="text" name="technique" id="technique" class="form-control @error('technique') is-invalid @enderror" value="{{ old('technique', $image->technique) }}">
                                @error('technique')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="keywords" class="form-label">Keywords</label>
                                <input type="text" name="keywords" id="keywords" class="form-control @error('keywords') is-invalid @enderror" value="{{ old('keywords', $image->keywords) }}">
                                <small class="text-muted">Separate keywords with commas.</small>
                                @error('keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Change Image</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Save Changes
                            </button>
                            <a href="{{ route('images.show', $image->id) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Back to Image
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
