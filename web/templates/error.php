<?php ob_start(); ?>

<div class="container text-center p-4">
    <div class="alert alert-danger" role="alert">
        <i class="fas fa-exclamation-triangle fa-3x mb-3" style="color: #dc3545;"></i>
        
        <?php 
            if (isset($params['mensaje'])) {
                echo "<b>" . htmlspecialchars($params['mensaje']) . "</b>";
            } else {
                echo "<b>Ha ocurrido un error inesperado. Por favor, intente nuevamente más tarde.</b>";
            }
        ?>
    </div>

    <h3 class="mt-4">¡Ups! Algo salió mal.</h3>

    <div class="text-center mt-2">
        <a href="index.php?ctl=home" class="text-decoration-none text-secondary">Volver al inicio</a>
    </div>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
