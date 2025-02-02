
<?php ob_start() ?>

<div class="container text-center mt-4">
    
    <div class="p-1 shadow-sm rounded">
        <h5 class="text-success">
            <b><?php echo $params['fecha'] ?></b>
        </h5>
    </div>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
