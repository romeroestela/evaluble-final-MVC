
<?php if (isset($_SESSION['idUser'])): ?>
    <div class="position-absolute start-1 m-1 p-2 bg-light border rounded shadow-sm d-flex align-items-center" style="max-width: 400px;">
        <?php
        // Comprobar si el usuario tiene una foto de perfil asignada
        $fotoPerfil = !empty($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : './imagenes/default_perfil.jpg'; 
        ?>
        <img src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil" class="img-fluid rounded-circle" style="width: 40px; height: 40px;">
        <span class="ms-2 fw-bold text-truncate"><?php echo $_SESSION['nombreUsuario']; ?></span>
        <a href="index.php?ctl=salir" class="btn btn-danger btn-sm ms-2">Cerrar Sesión</a>
    </div>
<?php endif; ?>
