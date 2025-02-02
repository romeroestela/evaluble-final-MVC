<?php ob_start(); ?>

<div class="container py-4">
    <h2 class="text-center mb-4">Recetas Saludables</h2>

    <?php if (empty($params['recetas'])): ?>
        <div class="alert alert-warning text-center">No hay recetas disponibles.</div>
    <?php else: ?>
        <div class="row justify-content-center">
            <?php foreach ($params['recetas'] as $receta): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100">
                        <img src="<?php echo htmlspecialchars($receta['imagenes_recetas']); ?>" class="card-img-top" alt="Receta" style="object-fit: cover; height: 200px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($receta['titulo']); ?></h5>
                            <p class="card-text"><strong>Ingredientes:</strong> <?php echo nl2br(htmlspecialchars($receta['ingredientes'])); ?></p>
                            <p class="card-text"><strong>Instrucciones:</strong> <?php echo nl2br(htmlspecialchars($receta['instrucciones'])); ?></p>
                            <!-- Para asegurarse de que el texto no desborde la tarjeta -->
                            <div class="mt-auto">
                                <a href="#" class="btn btn-info btn-sm">Ver receta</a>
                            </div>
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
