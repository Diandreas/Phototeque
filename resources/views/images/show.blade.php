@extends('layouts.app')

@section('content')
    <div class="min-vh-100 bg-light">
        <!-- Barre de Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Galerie</a></li>
                    <li class="breadcrumb-item active">N°:{{ $image->id }}</li>
                </ol>
                <div class="ms-auto">
                    <button class="btn btn-light" data-bs-toggle="offcanvas" data-bs-target="#imageHistory">
                        <i class="bi bi-clock-history"></i>
                    </button>
                    <div class="btn-group ms-2">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shareModal">
                            <i class="bi bi-share me-2"></i>Partager
                        </button>
                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('images.download', $image->id) }}">
                                    <i class="bi bi-download me-2"></i>Télécharger
                                </a></li>
                            <li><a class="dropdown-item" href="{{ route('images.edit', $image->id) }}">
                                    <i class="bi bi-pencil me-2"></i>Modifier
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contenu Principal -->
        <div class="container my-4">
            <div class="row g-4">
                <!-- Colonne de Gauche - Image -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <!-- Barre d'Outils de l'Image -->
                        <div class="bg-white border-bottom px-3 py-2 d-flex align-items-center">
                            <div class="btn-group">
                                <button class="btn btn-light" id="zoomIn">
                                    <i class="bi bi-zoom-in"></i>
                                </button>
                                <button class="btn btn-light" id="zoomOut">
                                    <i class="bi bi-zoom-out"></i>
                                </button>
                                <button class="btn btn-light" id="fitScreen">
                                    <i class="bi bi-arrows-angle-contract"></i>
                                </button>
                            </div>
                            <div class="ms-auto">
                                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#previewModal">
                                    <i class="bi bi-arrows-fullscreen"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Visionneuse d'Image -->
                        <div class="position-relative" style="height: 70vh;">
                            <div class="position-absolute top-0 start-0 w-100 h-100" id="imageViewer">
                                <img src="{{ asset('storage/' . $image->path) }}"
                                     class="w-100 h-100 object-fit-contain"
                                     alt="{{ $image->name }}"
                                     id="mainImage">
                            </div>
                            <img src="{{ asset('storage/images/OLC.jpeg') }}"
                                 class="position-absolute bottom-0 end-0 m-3"
                                 style="width: 80px; opacity: 0.6;"
                                 alt="Logo OLC">
                        </div>
                    </div>
                </div>

                <!-- Colonne de Droite - Infos & Actions -->
                <div class="col-lg-4">
                    <!-- Carte d'Infos Rapides -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title mb-0">{{ $image->name }}</h5>
                            <small class="text-muted">ID: {{ $image->identification_number }}</small>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block">Auteur</small>
                                        <span class="fw-medium">{{ $image->author }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block">Créé</small>
                                        <span class="fw-medium">{{ $image->creation_date }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation par Onglets -->
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-0">
                            <nav class="nav nav-tabs nav-fill" role="tablist">
                                <button class="nav-link active py-3" data-bs-toggle="tab" data-bs-target="#details">
                                    <i class="bi bi-info-circle d-block h4 mb-0"></i>
                                    <small>Détails</small>
                                </button>
                                <button class="nav-link py-3" data-bs-toggle="tab" data-bs-target="#metadata">
                                    <i class="bi bi-tag d-block h4 mb-0"></i>
                                    <small>Métadonnées</small>
                                </button>
                                <button class="nav-link py-3" data-bs-toggle="tab" data-bs-target="#comments">
                                    <i class="bi bi-chat d-block h4 mb-0"></i>
                                    <small>Commentaires</small>
                                </button>
                                <button class="nav-link py-3" data-bs-toggle="tab" data-bs-target="#modifications">
                                    <i class="bi bi-pencil-square d-block h4 mb-0"></i>
                                    <small>Modifier</small>
                                </button>
                            </nav>

                            <!-- Contenu des Onglets -->
                            <div class="tab-content p-4" style="max-height: 500px; overflow-y: auto;">
                                <!-- Onglet Détails -->
                                <div class="tab-pane fade show active" id="details">
                                    <p class="text-muted">{{ $image->description }}</p>
                                    <h6 class="mt-4 mb-3">Sujet Principal</h6>
                                    <p>{{ $image->main_subject }}</p>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex justify-content-between p-3 bg-light rounded">
                                            <span class="text-muted">Source</span>
                                            <span class="fw-medium">{{ $image->source }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between p-3 bg-light rounded">
                                            <span class="text-muted">Support</span>
                                            <span class="fw-medium">{{ $image->support }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between p-3 bg-light rounded">
                                            <span class="text-muted">Dimensions</span>
                                            <span class="fw-medium">{{ $image->dimensions }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Métadonnées -->
                                <div class="tab-pane fade" id="metadata">
                                    <div class="d-flex flex-column gap-3">
                                        <div class="p-3 bg-light rounded">
                                            <small class="text-muted d-block">Couleur</small>
                                            <span class="fw-medium">{{ $image->color }}</span>
                                        </div>
                                        <div class="p-3 bg-light rounded">
                                            <small class="text-muted d-block">Technique</small>
                                            <span class="fw-medium">{{ $image->technique }}</span>
                                        </div>
                                        <div class="p-3 bg-light rounded">
                                            <small class="text-muted d-block">Taille du Fichier</small>
                                            <span class="fw-medium">{{ number_format($image->size / 1024, 2) }} KB</span>
                                        </div>
                                    </div>

                                    <h6 class="mt-4 mb-3">Mots-clés</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($image->terms as $term)
                                            <span class="badge bg-secondary rounded-pill">{{ $term->name }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Onglet Commentaires -->
                                <div class="tab-pane fade" id="comments">
                                    <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                                        @csrf
                                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="description"
                                                   placeholder="Écrire un commentaire..." required>
                                            <button class="btn btn-primary">
                                                <i class="bi bi-send"></i>
                                            </button>
                                        </div>
                                    </form>

                                    <div class="comments-wrapper">
                                        @forelse($image->comments->sortByDesc('created_at') as $comment)
                                            <div class="d-flex gap-3 mb-3">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width: 32px; height: 32px;">
                                                        {{ strtoupper(substr($comment->user?->name ?? 'A', 0, 1)) }}
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="bg-light rounded p-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <small class="fw-medium">{{ $comment->user?->name ?? 'Anonyme' }}</small>
                                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                        </div>
                                                        <p class="mb-0">{{ $comment->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center py-4">
                                                <i class="bi bi-chat-left text-muted h1"></i>
                                                <p class="text-muted mt-2">Pas de commentaires pour le moment</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Onglet Modifications -->
                                <div class="tab-pane fade" id="modifications">
                                    <form action="{{ route('modifications.store') }}" method="POST" class="mb-4">
                                        @csrf
                                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                                        <select class="form-select mb-3" name="field" required>
                                            <option value="">Sélectionner le champ à modifier</option>
                                            <option value="name">Nom</option>
                                            <option value="description">Description</option>
                                            <option value="author">Auteur</option>
                                            <option value="source">Source</option>
                                            <option value="main_subject">Sujet Principal</option>
                                        </select>
                                        <textarea class="form-control mb-3" name="proposed_value" rows="3"
                                                  placeholder="Entrer la valeur proposée" required></textarea>
                                        <button type="submit" class="btn btn-primary w-100">
                                            Soumettre la Modification
                                        </button>
                                    </form>

                                    <div class="modifications-list">
                                        @forelse($image->proposedModifications()->where('status', 'pending')->get() as $mod)
                                            <div class="bg-light rounded p-3 mb-3">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="fw-medium">{{ $mod->user->name }}</small>
                                                    <span class="badge bg-warning">{{ $mod->field }}</span>
                                                </div>
                                                <p class="mb-3">{{ $mod->proposed_value }}</p>
                                                <div class="d-flex gap-2">
                                                    <form action="{{ route('modifications.update', $mod->id) }}"
                                                          method="POST" class="flex-grow-1">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="accepted">
                                                        <button type="submit" class="btn btn-success w-100">Accepter</button>
                                                    </form>
                                                    <form action="{{ route('modifications.update', $mod->id) }}"
                                                          method="POST" class="flex-grow-1">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="btn btn-danger w-100">Rejeter</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center py-4">
                                                <i class="bi bi-pencil text-muted h1"></i>
                                                <p class="text-muted mt-2">Pas de modifications en attente</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barre Latérale d'Historique -->
    <div class="offcanvas offcanvas-end" id="imageHistory">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Historique de l'Image</h5>
            <button class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="timeline">
                <!-- Exemples d'éléments de la timeline -->
                <div class="timeline-item mb-4">
                    <div class="timeline-indicator bg-primary rounded-circle"></div>
                    <div class="timeline-content">
                        <small class="text-muted">Aujourd'hui</small>
                        <div class="bg-light rounded p-3 mt-2">
                            <h6 class="mb-1">Image Téléchargée</h6>
                            <p class="mb-0 small">Version initiale téléchargée par {{ $image->user->name??'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Partage -->
    <div class="modal fade" id="shareModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Partager l'Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label">Lien de Partage</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ request()->url() }}" readonly>
                            <button class="btn btn-outline-primary" id="copyLink">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Partager avec des Collègues</label>
                        <div class="d-flex flex-wrap gap-2">
                            <!-- Exemples d'options de partage -->
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-envelope me-2"></i>Email
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-slack me-2"></i>Slack
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-microsoft-teams me-2"></i>Teams
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Plein Écran -->
    <div class="modal fade" id="previewModal">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content bg-dark">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white">{{ $image->name }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <img src="{{ asset('storage/' . $image->path) }}"
                         class="img-fluid"
                         style="max-height: 200vh;"
                         alt="{{ $image->name }}">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fonctionnalité de zoom de l'image
            const mainImage = document.getElementById('mainImage');
            const zoomIn = document.getElementById('zoomIn');
            const zoomOut = document.getElementById('zoomOut');
            const fitScreen = document.getElementById('fitScreen');
            let scale = 1;

            zoomIn.addEventListener('click', () => {
                scale = Math.min(scale * 1.2, 3);
                updateZoom();
            });

            zoomOut.addEventListener('click', () => {
                scale = Math.max(scale / 1.2, 0.5);
                updateZoom();
            });

            fitScreen.addEventListener('click', () => {
                scale = 1;
                updateZoom();
            });

            function updateZoom() {
                mainImage.style.transform = `scale(${scale})`;
            }

            // Fonctionnalité de copie du lien
            const copyLink = document.getElementById('copyLink');
            copyLink.addEventListener('click', () => {
                const shareUrl = document.querySelector('#shareModal input[type="text"]');
                shareUrl.select();
                document.execCommand('copy');

                copyLink.innerHTML = '<i class="bi bi-check"></i>';
                setTimeout(() => {
                    copyLink.innerHTML = '<i class="bi bi-clipboard"></i>';
                }, 2000);
            });

            // Gestion de la soumission des formulaires avec des états de chargement
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.disabled = true;
                        const originalContent = submitButton.innerHTML;
                        submitButton.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                    Traitement en cours...
                `;

                        setTimeout(() => {
                            if (submitButton.disabled) {
                                submitButton.disabled = false;
                                submitButton.innerHTML = originalContent;
                            }
                        }, 5000);
                    }
                });
            });

            // Initialisation de toutes les infobulles
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    delay: { show: 50, hide: 50 }
                });
            });
        });
    </script>
@endpush
