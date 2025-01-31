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

    //Funcion para salir de la sesión
    public function salir()
    {
        session_destroy();

        header("location:index.php?ctl=home");
    }

    //Funcion para mostrar el error en error.php
    public function error()
    {

        $menu = $this->cargaMenu();

        require __DIR__ . '/../../web/templates/error.php';
    }

    public function iniciarSesion()
    {
        try {
            $params = array(
                'nombreUsuario' => '',
                'contrasenya' => ''
            );
            $menu = $this->cargaMenu();

            if ($_SESSION['nivel_usuario'] > 0) {
                header("location:index.php?ctl=inicio");
            }
            if (isset($_POST['bIniciarSesion'])) { // Nombre del boton del formulario
                $nombreUsuario = recoge('nombreUsuario');
                $contrasenya = recoge('contrasenya');

                // Comprobar campos formulario. Aqui va la validación con las funciones de bGeneral   
                if (cUser($nombreUsuario, "nombreUsuario", $params)) {
                    // Si no ha habido problema creo modelo y hago consulta                    
                    $m = new GestionHabitos();
                    if ($usuario = $m->consultarUsuario($nombreUsuario)) {
                        // Compruebo si el password es correcto
                        if (comprobarhash($contrasenya, $usuario['contrasenya'])) {
                            // Obtenemos el resto de datos

                            $_SESSION['idUser'] = $usuario['idUser'];
                            $_SESSION['nombreUsuario'] = $usuario['nombreUsuario'];
                            $_SESSION['nivel_usuario'] = $usuario['nivel_usuario'];

                            header('Location: index.php?ctl=inicio');
                        }
                    } else {
                        $params = array(
                            'nombreUsuario' => $nombreUsuario,
                            'contrasenya' => $contrasenya
                        );
                        $params['mensaje'] = 'No se ha podido iniciar sesión. Revisa el formulario.';
                    }
                } else {
                    $params = array(
                        'nombreUsuario' => $nombreUsuario,
                        'contrasenya' => $contrasenya
                    );
                    $params['mensaje'] = 'Hay datos que no son correctos. Revisa el formulario.';
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../../web/templates/formInicioSesion.php';
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
 
             $foto_perfil = gestionarImagenPerfil('foto_perfil', "imagenes_profile", $errores);
 
             // Validaciones
             cTexto($nombre, "nombre", $errores);
             cTexto($apellido, "apellido", $errores);
             cUser($nombreUsuario, "nombreUsuario", $errores);
             cUser($contrasenya, "contrasenya", $errores);
 
             if (empty($errores)) {
                 try {
                     $m = new GestionHabitos();
                     if ($m->insertarUsuario($nombre, $apellido, $nombreUsuario, encriptar($contrasenya), $foto_perfil)) {
                        $_SESSION['foto_perfil'] = $foto_perfil;   // Guardar la ruta de la foto de perfil en la sesión
                        header('Location: index.php?ctl=iniciarSesion');
                     } else {
                         $params['mensaje'] = 'No se ha podido registrar el usuario.';
                     }
                 } catch (Exception $e) {
                     error_log($e->getMessage(), 3, "../app/log/logException.txt");
                     header('Location: index.php?ctl=error');
                 }
             } else {
                 $params = array(
                     'nombre' => $nombre,
                     'apellido' => $apellido,
                     'nombreUsuario' => $nombreUsuario,
                     'contrasenya' => $contrasenya
                 );
                 $params['mensaje'] = 'Datos incorrectos. Revisa el formulario.';
             }
         }
 
         require __DIR__ . '/../../web/templates/formRegistro.php';
     }

    public function insertarComida()
    {
        try {
            $params = array(
                'nombre' => '',
                'calorias' => '',
                'fecha' => ''
            );
            $errores = array();
            
        
            if (isset($_POST['bInsertarComida'])) {
                $nombre = recoge('nombre');
                $calorias = recoge('calorias');
                $fecha = recoge('fecha');
                $foto_comida = gestionarImagenComida('foto_comida', "imagenes_comidas", $errores); // Aquí gestionamos la imagen

                // Validar los campos
                cTexto($nombre, "nombre", $errores);
                cNum($calorias, "calorias", $errores);
                unixFechaAAAAMMDD($fecha, "fecha", $errores);

                if (empty($errores)) {
                    // Insertar la comida en la base de datos
                    $m = new GestionHabitos();
                    if ($m->insertarComida($_SESSION['idUser'], $nombre, $calorias, $foto_comida, $fecha)) {
                        header('Location: index.php?ctl=verComidas'); // Redirigir a la vista de comidas
                    } else {
                        $params = array(
                            'nombre' => $nombre,
                            'calorias' => $calorias,
                            'fecha' => $fecha
                        );
                        $params['mensaje'] = 'No se ha podido registrar la comida. Revisa el formulario.';
                    }
                } else {
                    $params = array(
                        'nombre' => $nombre,
                        'calorias' => $calorias,
                        'fecha' => $fecha
                    );
                    $params['mensaje'] = 'Hay datos incorrectos. Revisa el formulario.';
                }
            }

            require __DIR__ . '/../../web/templates/formInsertarActividad.php';

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }

        $menu = $this->cargaMenu();
    }

    public function verComidas()
    {
        try {
            // Obtener las comidas registradas del usuario
            $m = new GestionHabitos();
            $comidas = $m->obtenerComidas($_SESSION['idUser']);
            
            // Verifica si existen comidas
            if (empty($comidas)) {
                $params['mensaje'] = 'No has registrado comidas aún.';
            } else {
                $params['comidas'] = $comidas;
            }
            
            // Cargar la vista de ver comidas
            require __DIR__ . '/../../web/templates/verComidas.php';
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logException.txt");
            header('Location: index.php?ctl=error');
        }
    }

    public function insertarActividad()
    {
        try {
            $params = array(
                'tipo' => '',
                'duracion' => '',
                'calorias' => '',
                'fecha' => ''
            );
            $errores = array();
            
        
            if (isset($_POST['bInsertarActividad'])) {
                $tipo = recoge('tipo');
                $duracion = recoge('duracion');
                $calorias = recoge('calorias');
                $fecha = recoge('fecha');

                // Validar los campos
                cTexto($tipo, "tipo", $errores);
                cNum($duracion, "duracion", $errores);
                cNum($calorias, "calorias", $errores);
                unixFechaAAAAMMDD($fecha, "fecha", $errores);

                if (empty($errores)) {
                    // Insertar la comida en la base de datos
                    $m = new GestionHabitos();
                    if ($m->insertarActividad($_SESSION['idUser'], $tipo, $duracion, $calorias, $fecha)) {
                        header('Location: index.php?ctl=verActividades'); // Redirigir a la vista de Actividades
                    } else {
                        $params = array(
                            'tipo' => $tipo,
                            'duracion' => $duracion,
                            'calorias' => $calorias,
                            'fecha' => $fecha
                        );
                        $params['mensaje'] = 'No se ha podido registrar la actividad. Revisa el formulario.';
                    }
                } else {
                    $params = array(
                        'tipo' => $tipo,
                        'duracion' => $duracion,
                        'calorias' => $calorias,
                        'fecha' => $fecha
                    );
                    $params['mensaje'] = 'Hay datos incorrectos. Revisa el formulario.';
                }
            }

            require __DIR__ . '/../../web/templates/formInsertarActividad.php';

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }

        $menu = $this->cargaMenu();
    }

    public function verActividades()
    {
        try {
            $m = new GestionHabitos();
            $actividades = $m->obtenerActividades($_SESSION['idUser']);
            
            if (empty($actividades)) {
                $params['mensaje'] = 'No has registrado actividades aún.';
            } else {
                $params['actividades'] = $actividades;
            }
            
            require __DIR__ . '/../../web/templates/verActividades.php';
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logException.txt");
            header('Location: index.php?ctl=error');
        }
    }



}
?>
