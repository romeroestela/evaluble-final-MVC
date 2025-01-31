<?php ob_start(); ?>

<div class="container text-center py-4">
    <div class="col-md-12">
        <?php if(isset($params['mensaje'])): ?>
            <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $params['mensaje']; ?></span></b>
        <?php endif; ?>
    </div>
</div>

<div class="col-md-12">
    <?php foreach ($errores as $error): ?>
        <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $error . "<br>"; ?></span></b>
    <?php endforeach; ?>
</div>

<div class="container-fluid text-center">
    <div class="container">
        <h2>Registrar Actividad</h2>
        <form action="index.php?ctl=insertarActividad" method="post" enctype="multipart/form-data">
            <!-- Tipo de Actividad -->
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de la actividad</label>
                <input type="text" name="tipo" class="form-control" placeholder="Carrera" required>
            </div>

            <!-- Duración -->
            <div class="mb-3">
                <label for="duracion" class="form-label">Duración</label>
                <input type="number" name="duracion" class="form-control" placeholder="20" required>
            </div>

            <!-- Calorías -->
            <div class="mb-3">
                <label for="calorias" class="form-label">Calorías</label>
                <input type="number" name="calorias" class="form-control" placeholder="200" required>
            </div>

        
            <!-- Fecha de la comida -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de la Actividad</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>

            <button type="submit" name="bInsertarActividad" class="btn btn-success">Registrar Actividad</button>
        </form>
    </div>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
