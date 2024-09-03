@extends('layouts.app')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('termForm');
        const formTitle = document.getElementById('formTitle');
        const nameInput = document.getElementById('name');
        const methodField = document.getElementById('methodField');
        const cancelEditBtn = document.getElementById('cancelEdit');
        const editBtns = document.querySelectorAll('.edit-btn');
        const deleteForms = document.querySelectorAll('.delete-form');

        // Fonction pour réinitialiser le formulaire
        function resetForm() {
            form.reset();
            form.action = "{{ route('terms.store') }}";
            formTitle.textContent = 'Ajouter un nouveau terme';
            methodField.innerHTML = '';
            cancelEditBtn.style.display = 'none';
        }

        // Gérer l'édition
        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;

                form.action = `/terms/${id}`;
                formTitle.textContent = 'Modifier le terme';
                nameInput.value = name;
                methodField.innerHTML = '@method("PUT")';
                cancelEditBtn.style.display = 'inline-block';
            });
        });

        // Gérer l'annulation de l'édition
        cancelEditBtn.addEventListener('click', resetForm);

        // Confirmation de suppression
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer ce terme ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Gestion des termes</h1>

        <!-- Formulaire pour ajouter/modifier un terme -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 id="formTitle">Ajouter un nouveau terme</h5>
            </div>
            <div class="card-body">
                <form id="termForm" action="{{ route('terms.store') }}" method="POST">
                    @csrf
                    <div id="methodField"></div>
                    <div class="form-group">
                        <label for="name">Nom du terme</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
                    <button type="button" class="btn btn-secondary mt-3" id="cancelEdit" style="display:none;">Annuler</button>
                </form>
            </div>
        </div>

        <!-- Tableau des termes -->
        <div class="card">
            <div class="card-header">
                <h5>Liste des termes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="termsTableBody">
                        @foreach($terms as $term)
                            <tr>
                                <td>{{ $term->id }}</td>
                                <td>{{ $term->name }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $term->id }}" data-name="{{ $term->name }}">Modifier</button>
                                    <form action="{{ route('terms.destroy', $term->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
