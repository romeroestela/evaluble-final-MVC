<?php ob_start(); ?>

<div class="container py-4">
    <h2 class="text-center mb-4">Todas las Actividades Registradas</h2>

    <?php if (empty($params['actividades'])): ?>
        <div class="alert alert-warning text-center">No hay actividades registradas.</div>
    <?php else: ?>
        <div class="row justify-content-center">
            <?php foreach ($params['actividades'] as $actividad): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($actividad['tipo']); ?></h5>
                            <p class="card-text">
                                <strong>Usuario ID:</strong> <?php echo htmlspecialchars($actividad['idUser']); ?><br>
                                <strong>Duración:</strong> <?php echo htmlspecialchars($actividad['duracion']); ?> minutos<br>
                                <strong>Calorías quemadas:</strong> <?php echo htmlspecialchars($actividad['calorias']); ?> kcal<br>
                                <strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($actividad['fecha'])); ?>
                            </p>
                            <a href="index.php?ctl=eliminarActividad&id=<?php echo $actividad['idActividad']; ?>" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'volverMenu.php'; ?>
<?php $contenido = ob_get_clean(); ?>
<?php include 'layout.php'; ?>

