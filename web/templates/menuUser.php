

<div class="container text-center my-4">
    <h3 class="text-success">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombreUsuario']); ?> 👋</h3>
    <p class="text-muted">Gestiona tu alimentación y tus actividades fácilmente</p>
    
    <!-- Mostrar la imagen de perfil -->
    <div class="mb-4">
        <?php
        // Comprobar si el usuario tiene una foto de perfil asignada
        $fotoPerfil = !empty($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : '.\imagenes\default_perfil.jpg'; 
        ?>
        <img src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
    </div>
</div>


<div class="container text-center my-4">
    <div class="row justify-content-center">
        <!-- Botón para registrar una comida -->
        <div class="col-md-4 mb-3">
            <a href="index.php?ctl=insertarComida" class="btn btn-lg btn-primary w-100">
                <i class="fas fa-utensils"></i> Registrar Comida
            </a>
        </div>

        <!-- Botón para registrar una actividad -->
        <div class="col-md-4 mb-3">
            <a href="index.php?ctl=insertarActividad" class="btn btn-lg btn-primary w-100">
                <i class="fas fa-running"></i> Registrar Actividad
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <!-- Ver comidas registradas -->
        <div class="col-md-4 mb-3">
            <a href="index.php?ctl=verComidas" class="btn btn-lg btn-success w-100">
                <i class="fas fa-apple-alt"></i> Ver Comidas
            </a>
        </div>

        <!-- Ver actividades registradas -->
        <div class="col-md-4 mb-3">
            <a href="index.php?ctl=verActividades" class="btn btn-lg btn-success w-100">
                <i class="fas fa-dumbbell"></i> Ver Actividades
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <!-- Buscar por fecha -->
        <div class="col-md-4 mb-3">
            <a href="index.php?ctl=buscarPorFecha" class="btn btn-lg btn-warning w-100">
                <i class="fas fa-calendar-alt"></i> Buscar por Fecha
            </a>
        </div>

        <!-- Cerrar sesión -->
        <div class="col-md-4 mb-3">
            <a href="index.php?ctl=salir" class="btn btn-lg btn-danger w-100">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </div>
    </div>
</div>
