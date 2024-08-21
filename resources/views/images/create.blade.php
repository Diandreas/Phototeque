@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ajouter une nouvelle image</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nom de l'image</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="terms">Termes</label>
                <select class="form-control" id="terms" name="terms[]" multiple>
                    @foreach($terms as $term)
                        <option value="{{ $term->id }}">{{ $term->name }}</option>
                    @endforeach
                </select>
                <div id="selected-terms" class="mt-2"></div>
            </div>
            <div class="form-group">
                <label for="image-preview">Prévisualisation de l'image</label>
                <img id="image-preview" src="#" alt="Prévisualisation de l'image" class="img-fluid" style="display:none;">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
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
                    termDiv.classList.add('badge', 'badge-secondary', 'mr-2', 'mb-2');
                    termDiv.textContent = option.text;

                    const deleteButton = document.createElement('button');
                    deleteButton.classList.add('btn', 'btn-sm', 'btn-danger', 'ml-2');
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
