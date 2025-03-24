<?php include_once 'views/layout/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-user-circle me-2"></i>Mi Cuenta</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-3 text-center">
                            <div class="bg-light rounded-circle p-3 d-inline-block mb-3">
                                <i class="fas fa-user-circle fa-5x text-primary"></i>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold text-muted">Nombre de Usuario:</div>
                                <div class="col-md-8"><?php echo isset($user) && is_object($user) ? htmlspecialchars($user->username) : 'Usuario no disponible'; ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold text-muted">Correo Electrónico:</div>
                                <div class="col-md-8"><?php echo htmlspecialchars($user->email); ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 fw-bold text-muted">Fecha de Registro:</div>
                                <div class="col-md-8"><?php echo date('d/m/Y H:i', strtotime($user->created_at)); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-key me-2"></i>Cambiar Contraseña</h4>
                </div>
                <div class="card-body p-4">
                    <form action="index.php?route=change-password" method="post">
                        <div class="mb-4">
                            <label for="current_password" class="form-label fw-bold">Contraseña Actual</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input type="password" class="form-control border-start-0" id="current_password" name="current_password" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="new_password" class="form-label fw-bold">Nueva Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-key text-primary"></i>
                                </span>
                                <input type="password" class="form-control border-start-0" id="new_password" name="new_password" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="form-label fw-bold">Confirmar Nueva Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-check-circle text-primary"></i>
                                </span>
                                <input type="password" class="form-control border-start-0" id="confirm_password" name="confirm_password" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Cambiar Contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-danger text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-trash-alt me-2"></i>Eliminar Cuenta</h4>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-warning">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading">¡Advertencia!</h5>
                                <p class="mb-0">Esta acción eliminará permanentemente su cuenta y todos los cursos asociados. Esta acción no se puede deshacer.</p>
                            </div>
                        </div>
                    </div>

                    <form action="index.php?route=delete-account" method="post" onsubmit="return confirmDelete()">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt me-2"></i>Eliminar Mi Cuenta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción eliminará permanentemente tu cuenta y todos tus cursos. Esta acción no se puede deshacer.');
    }
</script>

<?php include_once 'views/layout/footer.php'; ?>