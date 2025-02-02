
<?php ob_start(); 
include 'headerUser.php'
?>

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

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
    <div class="text-center mb-2">
        <h2 class="text-success">Registrar Comida</h2>
    </div>

        <form action="index.php?ctl=insertarComida" method="post" enctype="multipart/form-data">
            <!-- Nombre de la comida -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la comida</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej. Ensalada" required>
            </div>

            <!-- Calorías -->
            <div class="mb-3">
                <label for="calorias" class="form-label">Calorías</label>
                <input type="number" name="calorias" class="form-control" placeholder="Ej. 200" required>
            </div>

            <!-- Foto de la comida -->
            <div class="mb-3">
                <label for="foto_comida" class="form-label">Foto de la comida</label>
                <input type="file" name="foto_comida" class="form-control" accept="image/*">
            </div>

            <!-- Fecha de la comida -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de la comida</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>

            <div class="text-center mt-3">
                <button type="submit" name="bInsertarComida" class="btn btn-success">Registrar Comida</button>
            </div>
            
            <?php include 'volverMenu.php'; ?>


        </form>
    </div>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
