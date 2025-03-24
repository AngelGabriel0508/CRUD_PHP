<?php include_once 'views/layout/header.php'; ?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary"><i class="fas fa-book me-2"></i>Mis Cursos</h2>
        <a href="index.php?route=courses&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Nuevo Curso
        </a>
    </div>

    <?php if ($num > 0): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                            <h5 class="card-title mb-0 text-truncate" title="<?php echo htmlspecialchars($row['name']); ?>">
                                <?php echo htmlspecialchars($row['name']); ?>
                            </h5>
                            <span class="badge bg-light text-primary"><?php echo htmlspecialchars($row['abbreviation']); ?></span>
                        </div>

                        <div class="card-body">
                            <div class="text-center mb-3">
                                <?php if (!empty($row['icon'])): ?>
                                    <img src="<?php echo $row['icon']; ?>" alt="Ícono del curso" class="img-fluid rounded" style="max-height: 120px;">
                                <?php else: ?>
                                    <div class="bg-light rounded p-4 d-flex justify-content-center align-items-center" style="height: 120px;">
                                        <i class="fas fa-book fa-4x text-primary"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <p class="card-text text-muted mb-1">
                                    <i class="fas fa-chalkboard me-2"></i> Aula: <?php echo htmlspecialchars($row['classroom']); ?>
                                </p>
                                <p class="card-text text-muted mb-1">
                                    <i class="fas fa-calendar-alt me-2"></i> ID: <?php echo $row['id']; ?>
                                </p>
                            </div>

                            <p class="card-text">
                                <?php
                                echo !empty($row['description'])
                                    ? htmlspecialchars(substr($row['description'], 0, 100)) . (strlen($row['description']) > 100 ? '...' : '')
                                    : '<span class="text-muted fst-italic">Sin descripción</span>';
                                ?>
                            </p>
                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between py-3">
                            <a href="index.php?route=courses&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                            <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-outline-danger">
                                <i class="fas fa-trash me-1"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <nav aria-label="Page navigation" class="mt-5">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?route=courses&page=<?php echo ($page - 1); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="index.php?route=courses&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?route=courses&page=<?php echo ($page + 1); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>

    <?php else: ?>
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-book-open fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">No hay cursos registrados</h4>
                <p class="mb-4">¡Comienza creando tu primer curso!</p>
                <a href="index.php?route=courses&action=create" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Crear Curso
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este curso?')) {
            window.location.href = 'index.php?route=courses&action=delete&id=' + id;
        }
    }
</script>

<?php include_once 'views/layout/footer.php'; ?>