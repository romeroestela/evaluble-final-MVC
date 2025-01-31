<?php ob_start(); ?>

<div class="container py-4">
    <h2 class="text-center mb-4">Buscar Registros por Fecha</h2>

    <!-- Formulario de búsqueda -->
    <form action="index.php?ctl=buscarPorFecha" method="post" class="text-center mb-4">
        <label for="fecha" class="form-label">Selecciona una fecha:</label>
        <input type="date" name="fecha" class="form-control d-inline-block w-auto" required>
        <button type="submit" name="bBuscarFecha" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Mensaje si no hay registros -->
    <?php if (isset($params['mensaje'])): ?>
        <div class="alert alert-warning text-center">
            <?php echo $params['mensaje']; ?>
        </div>
    <?php endif; ?>

    <!-- Mostrar comidas -->
    <?php if (!empty($params['comidas'])): ?>
        <h3 class="text-center mt-4">🍽️ Comidas Registradas</h3>
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
    <?php endif; ?>

    <!-- Mostrar actividades -->
    <?php if (!empty($params['actividades'])): ?>
        <h3 class="text-center mt-4">🏋️ Actividades Registradas</h3>
        <div class="row justify-content-center">
            <?php foreach ($params['actividades'] as $actividad): ?>
                <div class="col-md-4 mb-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($actividad['tipo']); ?></h5>
                            <p class="card-text">
                                <strong>Duración:</strong> <?php echo htmlspecialchars($actividad['duracion']); ?> min<br>
                                <strong>Calorías Quemadas:</strong> <?php echo htmlspecialchars($actividad['calorias']); ?> kcal<br>
                                <strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($actividad['fecha'])); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php include 'volverMenu.php'; ?>


</div>

<?php $contenido = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
