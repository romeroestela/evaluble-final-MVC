<?php

class Controller
{
    // Cargar menú según el nivel del usuario
    private function cargaMenu()
    {
        if ($_SESSION['nivel_usuario'] == 0) {
            return 'menuInvitado.php';
        } else if ($_SESSION['nivel_usuario'] == 1) {
            return 'menuUser.php';
        } else if ($_SESSION['nivel_usuario'] == 2) {
            return 'menuAdmin.php';
        }
    }

    public function home()
    {

        $params = array(
            'mensaje' => 'Bienvenido a tu gestor de hábitos saludables',
            'mensaje2' => 'Registra tus actividades y comidas para mejorar tu salud',
            'fecha' => date('d-m-Y')
        );
        $menu = 'menuHome.php';

        if ($_SESSION['nivel_usuario'] > 0) {
            header("location:index.php?ctl=inicio");
        }
        require __DIR__ . '/../../web/templates/inicio.php';
    }

    // Página principal
    public function inicio()
    {
        $params = array(
            'mensaje' => 'Registra tus actividades y comidas para mejorar tu salud',
            'fecha' => date('d-m-Y')
        );

        $menu = $this->cargaMenu();
        require __DIR__ . '/../../web/templates/inicio.php';
    }

    public function error()
    {

        $menu = $this->cargaMenu();

        require __DIR__ . '/../../web/templates/error.php';
    }

    // Formulario de registro
    public function registro()
    {
        $menu = $this->cargaMenu();

        if ($_SESSION['nivel_usuario'] > 0) {
            header("location:index.php?ctl=inicio");
        }

        $params = array(
            'nombre' => '',
            'apellido' => '',
            'nombreUsuario' => '',
            'contrasenya' => '',
        );

        $errores = array();

        if (isset($_POST['bRegistro'])) {
            $nombre = recoge('nombre');
            $apellido = recoge('apellido');
            $nombreUsuario = recoge('nombreUsuario');
            $contrasenya = recoge('contrasenya');

            $foto_perfil = gestionarImagenPerfil('foto_perfil', "web/imagenes/imagenes_profile", $errores);

            // Validaciones
            cTexto($nombre, "nombre", $errores);
            cTexto($apellido, "apellido", $errores);
            cUser($nombreUsuario, "nombreUsuario", $errores);
            cUser($contrasenya, "contrasenya", $errores);

            if (empty($errores)) {
                try {
                    $m = new GestionHabitos();
                    if ($m->insertarUsuario($nombre, $apellido, $nombreUsuario, encriptar($contrasenya), $foto_perfil)) {
                        header('Location: index.php?ctl=iniciarSesion');
                    } else {
                        $params['mensaje'] = 'No se ha podido registrar el usuario.';
                    }
                } catch (Exception $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
                    header('Location: index.php?ctl=error');
                }
            } else {
                $params['mensaje'] = 'Datos incorrectos. Revisa el formulario.';
            }
        }

        require __DIR__ . '/../../web/templates/formRegistro.php';
    }


}
?>
