@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5 bg-light">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="row g-0">
                        <!-- Image Column -->
                        <div class="col-md-6 p-0">
                            <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $image->name }}">
                        </div>
                        <!-- Information Column -->
                        <div class="col-md-6">
                            <div class="card-body">
                                <h1 class="card-title h2 mb-4">{{ $image->name }}</h1>

                                <!-- Tabs for organizing information -->
                                <ul class="nav nav-tabs" id="imageInfoTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">Details</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="false">Description</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="metadata-tab" data-bs-toggle="tab" data-bs-target="#metadata" type="button" role="tab" aria-controls="metadata" aria-selected="false">Metadata</button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3" id="imageInfoTabContent">
                                    <!-- Details Tab -->
                                    <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                                        <dl class="row">
                                            <dt class="col-sm-4">ID Number</dt>
                                            <dd class="col-sm-8">{{ $image->identification_number }}</dd>

                                            <dt class="col-sm-4">Creation Date</dt>
                                            <dd class="col-sm-8">{{ $image->creation_date }}</dd>

                                            <dt class="col-sm-4">Author</dt>
                                            <dd class="col-sm-8">{{ $image->author }}</dd>

                                            <dt class="col-sm-4">Source</dt>
                                            <dd class="col-sm-8">{{ $image->source }}</dd>

                                            <dt class="col-sm-4">Support</dt>
                                            <dd class="col-sm-8">{{ $image->support }}</dd>

                                            <dt class="col-sm-4">Dimensions</dt>
                                            <dd class="col-sm-8">{{ $image->dimensions }}</dd>
                                        </dl>
                                    </div>

                                    <!-- Description Tab -->
                                    <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                                        <p>{{ $image->description }}</p>
                                        <h5 class="mt-3">Main Subject</h5>
                                        <p>{{ $image->main_subject }}</p>
                                        <h5 class="mt-3">Represented Elements</h5>
                                        <p>{{ $image->represented_elements }}</p>
                                        <h5 class="mt-3">Actions Represented</h5>
                                        <p>{{ $image->actions_represented }}</p>
                                        <h5 class="mt-3">Context</h5>
                                        <p>{{ $image->context }}</p>
                                    </div>

                                    <!-- Metadata Tab -->
                                    <div class="tab-pane fade" id="metadata" role="tabpanel" aria-labelledby="metadata-tab">
                                        <dl class="row">
                                            <dt class="col-sm-4">Color</dt>
                                            <dd class="col-sm-8">{{ $image->color }}</dd>

                                            <dt class="col-sm-4">Technique</dt>
                                            <dd class="col-sm-8">{{ $image->technique }}</dd>

                                            <dt class="col-sm-4">File Size</dt>
                                            <dd class="col-sm-8">{{ number_format($image->size / 1024, 2) }} KB</dd>
                                        </dl>

                                        <h5 class="mt-3">Keywords</h5>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach(explode(',', $image->keywords) as $keyword)
                                                <span class="badge bg-secondary">{{ trim($keyword) }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 d-flex justify-content-end gap-2">
                                    <a href="{{ route('images.download', $image->id) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-download me-2"></i>Download
                                    </a>
                                    <a href="{{ route('images.edit', $image->id) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Simplified Comments Section -->
                <div class="card mt-5 shadow">
                    <div class="card-body">
                        <h2 class="card-title h4 mb-4">Comments</h2>
                        <ul class="list-group list-group-flush mb-4">
                            @forelse($image->comments as $comment)
                                <li class="list-group-item py-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-1">
                                                {{ $comment->user ? $comment->user->name : 'Deleted User' }}
                                            </h6>
                                            <p class="mb-1">{{ $comment->description }}</p>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">No comments yet.</li>
                            @endforelse
                        </ul>

                        <h3 class="h5 mb-3">Add a Comment</h3>
                        <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                            @csrf
                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <div class="mb-3">
                                <label for="description" class="form-label">Your Comment</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required></textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-chat-right-text me-2"></i>Post Comment
                            </button>
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
    <script>
        // Initialize Bootstrap tabs
        var triggerTabList = [].slice.call(document.querySelectorAll('#imageInfoTabs button'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    </script>
@endpush
