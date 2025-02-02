
<?php
if (!isset($_SESSION['nivel_usuario']) || $_SESSION['nivel_usuario'] != 2) {
    header("Location: index.php?ctl=home");
    exit();
}
?>

<div class="container text-center my-4">
    <h3 class="text-success">👑 Bienvenido, Administrador</h3>
    <p class="text-muted">Gestiona los hábitos saludables de los usuarios</p>
</div>


<div class="container text-center my-4">
    <!-- Mostrar la imagen de perfil -->
    <div class="mb-4">
        <?php
        // Comprobar si el usuario tiene una foto de perfil asignada
        $fotoPerfil = !empty($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : '.\imagenes\default_admin.jpg'; 
        ?>
        <img src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
    </div>
    
    <div class="row justify-content-center">
        <!-- Ver todas las comidas -->
        <div class="col-md-4 mb-3">
            <a href="index.php?ctl=verTodasComidas" class="btn btn-lg btn-primary w-100">
                <i class="fas fa-apple-alt"></i> Ver Todas las Comidas
            </a>
        </div>

        <!-- Ver todas las actividades -->
        <div class="col-md-4 mb-3">
            <a href="index.php?ctl=verTodasActividades" class="btn btn-lg btn-primary w-100">
                <i class="fas fa-dumbbell"></i> Ver Todas las Actividades
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <!-- Añadir Receta -->
        <div class="col-md-4 mb-3">
            <a href="index.php?ctl=insertarReceta" class="btn btn-lg btn-success w-100">
                <i class="fas fa-book"></i> Añadir Receta
            </a>
        </div>

        <!-- Ver Recetas -->
        <div class="col-md-4 mb-3">
            <a href="index.php?ctl=verRecetas" class="btn btn-lg btn-success w-100">
                <i class="fas fa-book-open"></i> Ver Recetas
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <!-- Cerrar sesión -->
        <div class="col-md-4 mb-3">
            <a href="index.php?ctl=salir" class="btn btn-lg btn-danger w-100">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </div>
    </div>
</div>
