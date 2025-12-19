<x-layout>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-" crossorigin="anonymous">
@endpush

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Crear carpeta</div>
                <div class="card-body">
                        <form id="folder-form">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback" id="error-name"></div>
                        </div>

                        <div class="mb-3">
                            <label for="owner" class="form-label">Owner</label>
                            <input type="number" class="form-control" id="owner" name="owner" placeholder="ID del usuario (ej. 1)">
                            <div class="invalid-feedback" id="error-owner"></div>
                        </div>

                            <div class="mb-3">
                                <label for="container" class="form-label">Contenedor (parent)</label>
                                <select id="container" class="form-select" name="container">
                                    <option value="">-- Ninguno (raíz) --</option>
                                </select>
                                <div class="invalid-feedback" id="error-container"></div>
                            </div>

                        <button type="submit" class="btn btn-primary">Crear</button>
                        <div class="mt-3" id="form-feedback"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Carpetas</div>
                <div class="card-body p-0">
                    <div class="p-3">
                        <div id="folders-tree">Cargando...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="" crossorigin="anonymous"></script>
    @vite(['resources/js/main.js', 'resources/js/folders.js', 'resources/js/editModal.js'])
@endpush

</x-layout>