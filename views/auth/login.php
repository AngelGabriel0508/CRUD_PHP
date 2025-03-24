<?php include_once 'views/layout/header.php'; ?>

<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow-lg">
            <div class="row g-0">
                <div class="col-md-5 bg-primary text-white d-flex flex-column justify-content-center align-items-center p-4" style="border-radius: 0.25rem 0 0 0.25rem;">
                    <div class="text-center py-5">
                        <i class="fas fa-graduation-cap fa-5x mb-4"></i>
                        <h2 class="fw-bold">EduLink</h2>
                        <p class="lead">Sistema de Gestión de Cursos</p>
                        <p class="mt-4">Accede a tu cuenta para gestionar tus cursos educativos.</p>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4 fw-bold text-primary">Iniciar Sesión</h2>

                        <form action="index.php?route=auth" method="post">
                            <input type="hidden" name="action" value="login">

                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </span>
                                    <input type="email" class="form-control border-start-0" id="email" name="email" placeholder="Correo Electrónico" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-primary"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0 border-end-0" id="password" name="password" placeholder="Contraseña" required>
                                    <button class="input-group-text bg-light border-start-0 toggle-password" type="button" data-target="password">
                                        <i class="fas fa-eye text-primary"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                </button>
                            </div>

                            <div class="text-center">
                                <p class="mb-0">¿No tienes una cuenta?
                                    <a href="index.php?route=register" class="text-primary fw-bold">Regístrate aquí</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');

                // Toggle password visibility
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    });
</script>

<?php include_once 'views/layout/footer.php'; ?>