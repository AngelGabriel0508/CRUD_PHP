<?php include_once 'views/layout/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Crear Nuevo Curso</h4>
                </div>
                <div class="card-body p-4">
                    <form action="index.php?route=courses&action=store" method="post" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Nombre del Curso</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-book text-primary"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="name" name="name" placeholder="Ej: Programación Web" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="abbreviation" class="form-label fw-bold">Abreviación</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-tag text-primary"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="abbreviation" name="abbreviation" placeholder="Ej: PW" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="classroom" class="form-label fw-bold">Aula</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-chalkboard text-primary"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" id="classroom" name="classroom" placeholder="Ej: Laboratorio 101" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Descripción</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-align-left text-primary"></i>
                                </span>
                                <textarea class="form-control border-start-0" id="description" name="description" rows="4" placeholder="Describe el contenido del curso..."></textarea>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="icon" class="form-label fw-bold">Ícono del Curso</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-image text-primary"></i>
                                </span>
                                <input type="file" class="form-control border-start-0" id="icon" name="icon" accept="image/*">
                            </div>
                            <div class="form-text">Seleccione una imagen para el ícono del curso (opcional). Tamaño recomendado: 200x200px.</div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="index.php?route=courses" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Curso
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/layout/footer.php'; ?>