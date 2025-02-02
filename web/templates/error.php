
<?php
$menu = null; // Evita que se cargue menuInvitado.php
ob_start(); 
?>

<div class="container text-center p-4">
    <div class="alert alert-danger" role="alert">
        <i class="fas fa-exclamation-triangle fa-3x mb-3" style="color: #dc3545;"></i>
        
        <?php 
            if (isset($params['mensaje'])) {
                echo "<b>" . htmlspecialchars($params['mensaje']) . "</b>";
            } else {
                echo "<b>Ha ocurrido un error inesperado.</b>";
            }
        ?>
    </div>

    <h3 class="mt-4">¡Ups! Algo salió mal.</h3>

    <?php include 'volverMenu.php'; ?>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
