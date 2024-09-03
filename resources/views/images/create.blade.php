@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Ajouter une nouvelle image</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nom de l'image</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="identification_number" class="form-label">Numéro d'identification</label>
                            <input type="text" class="form-control" id="identification_number" name="identification_number" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="creation_date" class="form-label">Date de création</label>
                            <input type="date" class="form-control" id="creation_date" name="creation_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="author" class="form-label">Auteur (photographe)</label>
                            <input type="text" class="form-control" id="author" name="author" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="source" class="form-label">Source (origine de l'image)</label>
                            <input type="text" class="form-control" id="source" name="source" required>
                        </div>
                        <div class="col-md-6">
                            <label for="support" class="form-label">Support de l'image</label>
                            <input type="text" class="form-control" id="support" name="support" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="dimensions" class="form-label">Dimensions</label>
                            <input type="text" class="form-control" id="dimensions" name="dimensions" required>
                        </div>
                        <div class="col-md-6">
                            <label for="color" class="form-label">Couleur</label>
                            <input type="text" class="form-control" id="color" name="color" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="technique" class="form-label">Technique utilisée</label>
                        <input type="text" class="form-control" id="technique" name="technique" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="main_subject" class="form-label">Sujet principal de l'image</label>
                        <input type="text" class="form-control" id="main_subject" name="main_subject" required>
                    </div>

                    <div class="mb-3">
                        <label for="represented_elements" class="form-label">Personnes, objets, lieux représentés</label>
                        <textarea class="form-control" id="represented_elements" name="represented_elements" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="actions_represented" class="form-label">Actions représentées</label>
                        <textarea class="form-control" id="actions_represented" name="actions_represented" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="context" class="form-label">Contexte historique, géographique ou social</label>
                        <textarea class="form-control" id="context" name="context" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="keywords" class="form-label">Mots-clés pertinents pour la recherche</label>
                        <textarea class="form-control" id="keywords" name="keywords" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>

                    <div class="mb-3">
                        <label for="terms" class="form-label">Termes</label>
                        <select class="form-control" id="terms" name="terms[]" multiple>
                            @foreach($terms as $term)
                                <option value="{{ $term->id }}">{{ $term->name }}</option>
                            @endforeach
                        </select>
                        <div id="selected-terms" class="mt-2"></div>
                    </div>

                    <div class="mb-3">
                        <label for="image-preview" class="form-label">Prévisualisation de l'image</label>
                        <img id="image-preview" src="#" alt="Prévisualisation de l'image" class="img-fluid rounded border" style="display:none;">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const termsSelect = document.getElementById('terms');
            const selectedTermsDiv = document.getElementById('selected-terms');
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');

            termsSelect.addEventListener('change', function() {
                const selectedOptions = Array.from(termsSelect.selectedOptions);
                selectedTermsDiv.innerHTML = '';

                selectedOptions.forEach(option => {
                    const termDiv = document.createElement('div');
                    termDiv.classList.add('badge', 'bg-secondary', 'me-2', 'mb-2');
                    termDiv.textContent = option.text;

                    const deleteButton = document.createElement('button');
                    deleteButton.classList.add('btn', 'btn-sm', 'btn-danger', 'ms-2');
                    deleteButton.textContent = '×';
                    deleteButton.addEventListener('click', function() {
                        option.selected = false;
                        termDiv.remove();
                    });

                    termDiv.appendChild(deleteButton);
                    selectedTermsDiv.appendChild(termDiv);
                });
            });

            const searchInput = document.createElement('input');
            searchInput.classList.add('form-control', 'mb-2');
            searchInput.placeholder = 'Rechercher des termes...';
            searchInput.addEventListener('input', function() {
                const query = searchInput.value.toLowerCase();
                Array.from(termsSelect.options).forEach(option => {
                    option.style.display = option.text.toLowerCase().includes(query) ? '' : 'none';
                });
            });

            termsSelect.parentNode.insertBefore(searchInput, termsSelect);

            imageInput.addEventListener('change', function() {
                const file = imageInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
