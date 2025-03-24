<?php include_once 'views/layout/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Editar Curso</h4>
                </div>
                <div class="card-body p-4">
                    <form action="index.php?route=courses&action=update" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo isset($course) && is_object($course) ? $course->id : ''; ?>">

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Nombre del Curso</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-book text-primary"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="name" name="name" value="<?php echo htmlspecialchars($course->name); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="abbreviation" class="form-label fw-bold">Abreviación</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-tag text-primary"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="abbreviation" name="abbreviation" value="<?php echo htmlspecialchars($course->abbreviation); ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="classroom" class="form-label fw-bold">Aula</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-chalkboard text-primary"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" id="classroom" name="classroom" value="<?php echo htmlspecialchars($course->classroom); ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Descripción</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-align-left text-primary"></i>
                                </span>
                                <textarea class="form-control border-start-0" id="description" name="description" rows="4"><?php echo htmlspecialchars($course->description); ?></textarea>
                            </div>
                        </div>

                        <?php if (!empty($course->icon)): ?>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Ícono Actual</label>
                                <div class="text-center p-3 bg-light rounded mb-3">
                                    <img src="<?php echo $course->icon; ?>" alt="Ícono del curso" class="img-fluid rounded" style="max-height: 150px;">
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <label for="icon" class="form-label fw-bold">Nuevo Ícono</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-image text-primary"></i>
                                </span>
                                <input type="file" class="form-control border-start-0" id="icon" name="icon" accept="image/*">
                            </div>
                            <div class="form-text">Seleccione una nueva imagen para reemplazar el ícono actual (opcional).</div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="index.php?route=courses" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Actualizar Curso
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/layout/footer.php'; ?>