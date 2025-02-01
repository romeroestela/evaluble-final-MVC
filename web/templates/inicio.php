<?php ob_start() ?>

<h5 class="text-left"><b><?php echo $params['fecha'] ?></b></h3><br>  

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>