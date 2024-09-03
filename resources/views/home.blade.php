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

    .card-img-top {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.3s ease;
    }

    .card {
        position: relative;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-details {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 1rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .card:hover .card-details {
        opacity: 1;
    }

    #backToTop {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        z-index: 1000;
        transition: opacity 0.3s ease-in-out;
        opacity: 0;
    }

    #backToTop.show {
        opacity: 1;
    }

    .like-button, .comment-button {
        transition: transform 0.2s ease;
    }

    .like-button:hover, .comment-button:hover {
        transform: scale(1.1);
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
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-secondary me-2 like-button" data-image-id="{{ $image->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Like this image">
                                        <i class="bi bi-heart"></i> <span class="likes-count">{{ $image->likes_count }}</span>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary comment-button" data-image-id="{{ $image->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Comment on this image">
                                        <i class="bi bi-chat"></i> <span class="comments-count">{{ $image->comments_count }}</span>
                                    </button>
                                </div>
                                <div>
                                    <a href="{{ route('images.show', $image->id) }}" class="btn btn-primary btn-sm">Voir plus</a>
                                </div>
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
