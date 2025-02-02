
<?php
$menu = null; // Evita que se cargue menuInvitado.php
ob_start(); 
?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <h2 class="text-success">Registrarse</h2>
            <p class="text-muted">Crea tu cuenta y empieza a gestionar tus hábitos</p>
        </div>

        <!-- Mensajes de error -->
        <?php if(isset($params['mensaje'])): ?>
            <div class="alert alert-danger text-center">
                <?php echo $params['mensaje']; ?>
            </div>
        <?php endif; ?>

        <?php foreach ($errores as $error): ?>
            <div class="alert alert-warning text-center">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <!-- Formulario de Registro -->
        <form action="index.php?ctl=registro" method="post" name="formRegistro" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $params['nombre'] ?? ''; ?>" placeholder="Nombre">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellido</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" name="apellido" value="<?php echo $params['apellido'] ?? ''; ?>" placeholder="Apellido">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre de usuario</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                    <input type="text" class="form-control" name="nombreUsuario" value="<?php echo $params['nombreUsuario'] ?? ''; ?>" placeholder="Nombre de usuario">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="contrasenya" placeholder="Contraseña">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto de perfil (opcional)</label>
                <input type="file" class="form-control" name="foto_perfil" accept="image/*">
            </div>

            <div class="d-grid">
                <button type="submit" name="bRegistro" class="btn btn-success">Registrarse</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <a href="index.php?ctl=iniciarSesion" class="text-decoration-none">Ya tengo una cuenta</a>
        </div>
        <div class="text-center mt-2">
            <a href="index.php?ctl=home" class="text-decoration-none text-secondary">Volver al inicio</a>
        </div>
    </div>
</div>

<?php
$contenido = ob_get_clean(); //Captura y limpia el contenido, asignándolo a $contenido, que luego se muestra en layout.php
include 'layout.php';
?>
