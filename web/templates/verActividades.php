<?php ob_start(); ?>

<div class="container py-4">
    <h2 class="text-center mb-4">Mis Actividades Registradas</h2>
    
    <?php if (isset($params['mensaje'])): ?>
        <div class="alert alert-warning text-center">
            <?php echo $params['mensaje']; ?>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <?php foreach ($params['actividades'] as $actividades): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($actividades['tipo']); ?></h5>
                        <p class="card-text">
                            <strong>Duración:</strong> <?php echo htmlspecialchars($actividades['duracion']); ?> min<br>
                            <strong>Calorías:</strong> <?php echo htmlspecialchars($actividades['calorias']); ?> kcal<br>
                            <strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($actividades['fecha'])); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php include 'volverMenu.php'; ?>

</div>

<?php $contenido = ob_get_clean(); ?>

<?php include 'layout.php'; ?>