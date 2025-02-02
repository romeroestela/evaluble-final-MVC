
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
    <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
    <div class="text-center mb-2">
        <h2 class="text-success">Añadir Nueva Receta</h2>
    </div>    

        <form action="index.php?ctl=insertarReceta" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ingredientes</label>
                <textarea name="ingredientes" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Instrucciones</label>
                <textarea name="instrucciones" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input type="file" name="imagenes_recetas" class="form-control" required>
            </div>

            
            <div class="text-center mt-3">
            <button type="submit" name="bInsertarReceta" class="btn btn-success">Añadir Receta</button>
                <a href="index.php?ctl=verRecetas" class="btn btn-warning">Ver Recetas</a>
            </div>
            
            <?php include 'volverMenu.php'; ?>
        </form>
    </div>    

</div>

<?php $contenido = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
