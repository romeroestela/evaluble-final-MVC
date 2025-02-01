<?php ob_start(); ?>

<div class="container py-4">
    <h2 class="text-center mb-4">Todas las Comidas Registradas</h2>

    <?php if (empty($params['comidas'])): ?>
        <div class="alert alert-warning text-center">No hay comidas registradas.</div>
    <?php else: ?>
        <div class="row justify-content-center">
            <?php foreach ($params['comidas'] as $comida): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo $comida['foto_comida']; ?>" class="card-img-top" alt="Comida" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($comida['nombre']); ?></h5>
                            <p class="card-text">
                                <strong>Usuario ID:</strong> <?php echo htmlspecialchars($comida['idUser']); ?><br>
                                <strong>Calorías:</strong> <?php echo htmlspecialchars($comida['calorias']); ?> kcal<br>
                                <strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($comida['fecha'])); ?>
                            </p>
                            <a href="index.php?ctl=eliminarComida&id=<?php echo $comida['idComida']; ?>" class="btn btn-danger">Eliminar</a>
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
