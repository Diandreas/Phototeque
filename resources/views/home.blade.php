@extends('layouts.app')

<style>
    .masonry {
        column-count: 4;
        column-gap: 1rem;
    }

    .masonry-item {
        display: inline-block;
        margin-bottom: 1rem;
        width: 100%;
        break-inside: avoid;
    }

    .card-details {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 1rem;
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
        transform: translateY(100%);
    }

    .card:hover .card-details {
        opacity: 1;
        transform: translateY(0);
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.3rem 0.5rem;
        margin: 0.2rem;
        transition: background-color 0.3s ease, transform 0.2s ease;
        display: inline-block;
    }

    .badge:hover {
        background-color: #5a6268;
        transform: scale(1.05);
    }

    .terms-container {
        margin-top: 0.5rem;
        max-height: 3.6em;
        overflow-y: auto;
    }

    .card-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.5rem;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>

<script>
    document.addEventListener('scroll', function() {
        const backToTopButton = document.getElementById('backToTop');

        if (window.scrollY > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });

    document.getElementById('backToTop').addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Like functionality with animation
        document.querySelectorAll('.like-button').forEach(button => {
            button.addEventListener('click', function() {
                const imageId = this.dataset.imageId;
                const likesCount = this.querySelector('.likes-count');
                fetch(`/images/${imageId}/like`, { method: 'POST' })
                    .then(response => response.json())
                    .then(data => {
                        likesCount.textContent = data.likes_count;
                        this.classList.toggle('btn-outline-secondary');
                        this.classList.toggle('btn-secondary');
                        this.classList.add('like-animation');
                    });
            });
        });

        // Add image functionality with feedback
        const addImageForm = document.getElementById('addImageForm');
        const submitImageButton = document.getElementById('submitImageButton');

        submitImageButton.addEventListener('click', function() {
            const formData = new FormData(addImageForm);
            fetch('/images', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error adding image. Please try again.');
                    }
                });
        });
    });
</script>

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <h1 class="display-4 text-center mb-4">Photothèque</h1>
                <p class="lead text-center mb-5">Découvrez notre riche collection d'images et interagissez avec notre communauté.</p>

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <form action="{{ route('home') }}" method="GET" class="input-group mb-3 mb-md-0 me-md-3" style="max-width: 300px;">
                        <input type="text" class="form-control" placeholder="Rechercher des images" aria-label="Rechercher" name="search" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <div>
                        <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#addImageModal">
                            <i class="bi bi-plus-lg"></i> Ajouter une image
                        </button>
                        <a href="{{ route('images.create') }}" class="btn btn-primary">
                            <i class="bi bi-upload"></i> Téléverser
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="masonry" id="imageGallery">
            @foreach($images as $image)
                <div class="masonry-item">
                    <div class="card shadow-sm">
                        <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top" alt="{{ $image->name }}">
                        <div class="card-details">
                            <h5 class="card-title">{{ $image->name }}</h5>
                            <div class="card-actions">
                                <div>

                                    <button class="btn btn-sm btn-outline-light comment-button" data-image-id="{{ $image->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Comment on this image">
                                        <i class="bi bi-chat"></i> <span class="comments-count">{{ $image->comments_count }}</span>
                                    </button>
                                </div>
                                <a href="{{ route('images.show', $image->id) }}" class="btn btn-sm btn-primary">Voir plus</a>
                            </div>
                            <div class="terms-container">
                                @foreach($image->terms as $term)
                                    <a href="{{ route('home', ['category' => $term->name]) }}" class="badge bg-secondary text-decoration-none">
                                        {{ $term->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                {{-- {{ $images->links() }} --}}
            </nav>
        </div>
    </div>

    <!-- Add Image Modal -->
    <div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">Ajouter une nouvelle image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addImageForm">
                        <div class="mb-3">
                            <label for="imageName" class="form-label">Nom de l'image</label>
                            <input type="text" class="form-control" id="imageName" required>
                        </div>
                        <div class="mb-3">
                            <label for="imageDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="imageDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="imageFile" class="form-label">Fichier image</label>
                            <input type="file" class="form-control" id="imageFile" accept="image/*" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="submitImageButton">Ajouter</button>
                </div>
            </div>
        </div>
    </div>

    <button id="backToTop" class="btn btn-primary">↑</button>
@endsection

@section('scripts')
    <script>
        // Initialize tooltips
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
            new bootstrap.Tooltip(el);
        });
    </script>
@endsection
