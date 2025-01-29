<?php ob_start() ?>

<div class="">
    <div class="" id="cabecera">
        <h1 class="">FORMULARIO PARA REGISTRARSE</h1>
    </div>
</div>

<!-- Mostrar mensajes de error o éxito -->
<div class="">
    <div class="">
        <?php if(isset($params['mensaje'])) :?>
            <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $params['mensaje'] ?></span></b>
        <?php endif; ?>
    </div>
    <div class="">
        <?php if (isset($errores) && is_array($errores)) { 
            foreach ($errores as $error) { ?>
                <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $error."<br>"; ?></span></b>
        <?php } 
        } ?>
    </div>
</div>

<!-- Formulario de Registro -->
<div class="">
    <form action="index.php?ctl=registro" method="post" enctype="multipart/form-data" name="formRegistro">
        <p>* <input type="text" name="nombre" value="<?php echo $params['nombre'] ?? '' ?>" placeholder="Nombre"><br></p>
        <p>* <input type="text" name="apellido" value="<?php echo $params['apellido'] ?? '' ?>" placeholder="Apellido"><br></p>
        <p>* <input type="text" name="nombreUsuario" value="<?php echo $params['nombreUsuario'] ?? '' ?>" placeholder="Nombre de usuario"><br></p>
        <p>* <input type="password" name="contrasenya" placeholder="Contraseña"><br></p>

        <!-- Foto de perfil (opcional) -->
        <p>Foto de perfil: <input type="file" name="foto_perfil"><br></p>

        <input type="submit" name="bRegistro" value="Aceptar"><br>
    </form>
</div>

<?php $contenido = ob_get_clean() ?>
--<?php include 'layout.php' ?>
