
<?php
$menu = null; // Evita que se cargue menuInvitado.php
ob_start();
?>

<!-- Mensaje para administradores (encima del formulario) -->
<div class="text-center mb-3 text-muted">
    <small>Si eres administrador, usa tu nombre de usuario y contraseña asignados.</small>
</div>

<div class="container d-flex justify-content-center align-items-center min-vh-50">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 15px;">
        <div class="text-center mb-4">
            <h2 class="text-success">Iniciar Sesión</h2>
            <p class="text-muted">Accede a tu cuenta para gestionar tus hábitos saludables</p>
        </div>

        <!-- Mensajes de error -->
        <?php if (isset($params['mensaje'])): ?>
            <div class="alert alert-danger text-center">
                <?php echo $params['mensaje']; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de inicio de sesión -->
        <form action="index.php?ctl=iniciarSesion" method="post" name="formIniciarSesion">
            <div class="mb-3">
                <label class="form-label">Nombre de usuario</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" name="nombreUsuario" placeholder="Nombre de usuario" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="contrasenya" placeholder="Contraseña" required>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" name="bIniciarSesion" class="btn btn-success">Iniciar Sesión</button>
            </div>
        </form>

        <!-- Enlaces adicionales -->
        <div class="text-center mt-3">
            <a href="index.php?ctl=registro" class="text-decoration-none">¿No tienes cuenta? Regístrate</a>
        </div>
        <div class="text-center mt-2">
            <a href="index.php?ctl=home" class="text-decoration-none text-secondary">Volver al inicio</a>
        </div>
    </div>
</div>

<?php
$contenido = ob_get_clean();
include 'layout.php';
?>
