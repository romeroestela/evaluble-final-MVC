<?php ob_start(); ?>

<div class="container py-4">
    <h2 class="text-center mb-4">Mis Comidas Registradas</h2>
    
    <?php if (isset($params['mensaje'])): ?>
        <div class="alert alert-warning text-center">
            <?php echo $params['mensaje']; ?>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <?php foreach ($params['comidas'] as $comida): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $comida['foto_comida']; ?>" class="card-img-top" alt="Comida" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($comida['nombre']); ?></h5>
                        <p class="card-text">
                            <strong>Calorías:</strong> <?php echo htmlspecialchars($comida['calorias']); ?> kcal<br>
                            <strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($comida['fecha'])); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php $contenido = ob_get_clean(); ?>

<?php include 'layout.php'; ?>
