
<?php ob_start(); 
include 'headerUser.php'
?>

<div class="container text-center py-4">
    <div class="col-md-12">
        <?php if (isset($params['mensaje'])): ?>
            <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $params['mensaje']; ?></span></b>
        <?php endif; ?>
    </div>
</div>

<div class="col-md-12">
    <?php foreach ($errores as $error): ?>
        <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $error . "<br>"; ?></span></b>
    <?php endforeach; ?>
</div>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
    <div class="text-center mb-4">
        <h2 class="text-success">Registrar Actividad</h2>
    </div>
        
        <form action="index.php?ctl=insertarActividad" method="post" enctype="multipart/form-data">
            
            <!-- Tipo de Actividad -->
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de la actividad</label>
                <input type="text" name="tipo" class="form-control" placeholder="Carrera" required>
            </div>

            <!-- Duración -->
            <div class="mb-3">
                <label for="duracion" class="form-label">Duración (en minutos)</label>
                <input type="number" name="duracion" class="form-control" placeholder="20" required>
            </div>

            <!-- Calorías -->
            <div class="mb-3">
                <label for="calorias" class="form-label">Calorías quemadas</label>
                <input type="number" name="calorias" class="form-control" placeholder="200" required>
            </div>

            <!-- Fecha de la Actividad -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de la Actividad</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" name="bInsertarActividad" class="btn btn-success">Registrar Actividad</button>
            </div>

            <?php include 'volverMenu.php'; ?>

        </form>
    </div>
</div>

<?php 
$contenido = ob_get_clean();
include 'layout.php'; 
?>
