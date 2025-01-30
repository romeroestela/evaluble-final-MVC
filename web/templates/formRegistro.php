
<?php
$menu = null; // Evita que se cargue menuInvitado.php
ob_start(); //Inicia el buffer de salida (almacena la salida en memoria en lugar de enviarla directamente al navegador) 
?>

<div class="container text-center p-4">
    <h1 class="h1Inicio">REGISTRARSE</h1>
</div>

<div class="container text-center py-2">
    <?php if(isset($params['mensaje'])) : ?>
        <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $params['mensaje'] ?></span></b>
    <?php endif; ?>

    <?php foreach ($errores as $error) : ?>
        <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $error."<br>"; ?></span></b>
    <?php endforeach; ?>
</div>

<div class="container text-center p-1">
    <form action="index.php?ctl=registro" method="post" name="formRegistro">
        <p>* <input type="text" name="nombre" value="<?php echo $params['nombre'] ?>" placeholder="Nombre"></p>
        <p>* <input type="text" name="apellido" value="<?php echo $params['apellido'] ?>" placeholder="Apellido"></p>
        <p>* <input type="text" name="nombreUsuario" value="<?php echo $params['nombreUsuario'] ?>" placeholder="Nombre de usuario"></p>
        <p>* <input type="password" name="contrasenya" value="<?php echo $params['contrasenya'] ?>" placeholder="Contraseña"></p>
        <input type="submit" name="bRegistro" value="Aceptar">
    </form>
</div>

<div class="container text-center">
    <a href="index.php?ctl=home" class="btn btn-success">Volver al inicio</a>
    <a href="index.php?ctl=iniciarSesion" class="btn btn-success">Ya estoy registrado</a>
</div>

<?php
$contenido = ob_get_clean(); //Captura y limpia el contenido, asignándolo a $contenido, que luego se muestra en layout.php
include 'layout.php';
?>
