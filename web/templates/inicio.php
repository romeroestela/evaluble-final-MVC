<?php ob_start(); ?>

<h3 class="text-center"><b><?php echo $params['mensaje'] ?? "Bienvenido a tu gestor de hábitos saludables"; ?></b></h3><br>
<h4 class="text-center"><?php echo $params['mensaje2'] ?? "Registra tus actividades y comidas para mejorar tu salud"; ?></h4><br>
<h3 class="text-center"><b><?php echo $params['fecha'] ?? date("d-m-Y"); ?></b></h3><br>  
<?php $contenido = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
