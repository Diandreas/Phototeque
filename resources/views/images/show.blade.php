@extends('layouts.app')
<style>
    .image-container {
        max-height: 600px;
        position: relative;
    }
    .watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0.2;
        width: 50%;
        height: auto;
        pointer-events: none;
    }
    #imageInfoTabs {
        flex-wrap: nowrap;
        overflow-x: auto;
    }
    #imageInfoTabs .nav-link {
        white-space: nowrap;
    }
    .card {
        background-color: rgba(255, 255, 255, 0.9);
    }
    .nav-tabs .nav-link {
        transition: all 0.3s ease;
    }
    .nav-tabs .nav-link:hover {
        background-color: rgba(0,0,0,0.1);
    }
    .btn {
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

</style>
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
@section('content')
    <div class="container-fluid " style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">

    <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="row g-0">
                        <!-- Image Column -->
                        <div class="col-md-5 ">
                            <div class="image-container" style="height: 100%; overflow: hidden; position: relative;">
                                <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="{{ $image->name }}" style="position: absolute; top: 0; left: 0;">
                                <img src="{{ asset('storage/images/OLC.jpeg')}}" class="watermark" alt="Logo OLC">
                            </div>
                        </div>
                        <!-- Information Column -->
                        <div class="col-md-7">
                            <div class="card-body p-4">
                                <h1 class="card-title h3 mb-4">{{ $image->name }}</h1>

                                <!-- Tabs for organizing information -->
                                <ul class="nav nav-tabs  flex-nowrap" id="imageInfoTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">Details</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="false">Description</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="metadata-tab" data-bs-toggle="tab" data-bs-target="#metadata" type="button" role="tab" aria-controls="metadata" aria-selected="false">Metadata</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="modifications-tab" data-bs-toggle="tab" data-bs-target="#modifications" type="button" role="tab" aria-controls="modifications" aria-selected="false">Modifications</button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-4" id="imageInfoTabContent">
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
                                        <p class="mb-3">{{ $image->description }}</p>
                                        <h5 class="h6 mt-4">Main Subject</h5>
                                        <p>{{ $image->main_subject }}</p>

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
                                        <h5 class="h6 mt-4">Keywords</h5>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach( $image->terms as $keyword)
                                                <span class="badge bg-secondary">{{$keyword->name}}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Modifications Tab -->
                                    <div class="tab-pane fade" id="modifications" role="tabpanel" aria-labelledby="modifications-tab">
                                        <h5 class="h6 mb-3">Propose a Modification</h5>
                                        <form action="{{ route('modifications.store') }}" method="POST" class="mb-4">
                                            @csrf
                                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                                            <div class="mb-3">
                                                <label for="field" class="form-label">Field to modify</label>
                                                <select class="form-select" id="field" name="field" required>
                                                    <option value="name">Name</option>
                                                    <option value="description">Description</option>
                                                    <option value="author">Author</option>
                                                    <option value="source">Source</option>
                                                    <option value="main_subject">Main Subject</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="proposed_value" class="form-label">Proposed Value</label>
                                                <textarea class="form-control" id="proposed_value" name="proposed_value" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-send me-2"></i>Propose Modification
                                            </button>
                                        </form>

                                        <h5 class="h6 mb-3">Pending Modifications</h5>
                                        <ul class="list-group list-group-flush">
                                            @forelse($image->proposedModifications()->where('status', 'pending')->get() as $modification)
                                                <li class="list-group-item py-3">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h6 class="mb-1">{{ $modification->user->name }} proposed a change to {{ $modification->field }}</h6>
                                                            <p class="mb-1">Proposed value: {{ $modification->proposed_value }}</p>
                                                            <small class="text-muted">{{ $modification->created_at->diffForHumans() }}</small>
                                                        </div>
{{--                                                        @if(Auth::user()->isAdmin())--}}
                                                            <div>
                                                                <form action="{{ route('modifications.update', $modification->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="status" value="accepted">
                                                                    <button type="submit" class="btn btn-sm btn-outline-success">Accept</button>
                                                                </form>
                                                                <form action="{{ route('modifications.update', $modification->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="status" value="rejected">
                                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Reject</button>
                                                                </form>
                                                            </div>
{{--                                                        @endif--}}
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="list-group-item">No pending modifications.</li>
                                            @endforelse
                                        </ul>
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

                <!-- Comments Section -->
                <div class="card mt-5 shadow-sm">
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
    <style>
        .image-container {
            max-height: 600px;
        }
    </style>
@endpush

@push('scripts')

@endpush
