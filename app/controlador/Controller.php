<?php

class Controller
{
    // Cargar menú según el nivel del usuario
    private function cargaMenu()
    {
        if ($_SESSION['nivel_usuario'] == 0) {
            return 'menuInvitado.php'; // Menú para usuarios no registrados
        } else if ($_SESSION['nivel_usuario'] == 1) {
            return 'menuUser.php'; // Menú para usuarios normales
        } else if ($_SESSION['nivel_usuario'] == 2) {
            return 'menuAdmin.php'; // Menú para administradores
        }
    }

    // Página de inicio pública
    public function home()
    {

        $params = array(
            'fecha' => date('Y-d-m')
        );
        $menu = 'menuHome.php';

        if ($_SESSION['nivel_usuario'] > 0) {
            header("location:index.php?ctl=inicio");
        }
        require __DIR__ . '/../../web/templates/inicio.php';
    }

    // Página principal para los usuarios registrados
    public function inicio()
    {
        $params = array(
            'fecha' => date('d-m-Y')
        );

        $menu = $this->cargaMenu();
        require __DIR__ . '/../../web/templates/inicio.php';
    }

    // Cierra la sesión del usuario y lo redirige a la página principal
    public function salir()
    {
        session_destroy();

        header("location:index.php?ctl=home");
    }

    // Muestra una pantalla de error cuando ocurre un problema
    public function error()
    {

        $menu = $this->cargaMenu();

        require __DIR__ . '/../../web/templates/error.php';
    }

     // Función para iniciar sesión de usuarios registrados
    public function iniciarSesion()
    {
        try {
            $params = array(
                'nombreUsuario' => '',
                'contrasenya' => ''
            );
            $menu = $this->cargaMenu();

            // Si el usuario ya está logueado, lo redirige al inicio
            if ($_SESSION['nivel_usuario'] > 0) {
                header("location:index.php?ctl=inicio");
            }
            // Verifica si se ha enviado el formulario de inicio de sesión
            if (isset($_POST['bIniciarSesion'])) {
                $nombreUsuario = recoge('nombreUsuario');
                $contrasenya = recoge('contrasenya');
   
                if (cUser($nombreUsuario, "nombreUsuario", $params)) {                    
                    $m = new GestionHabitos();
                    if ($usuario = $m->consultarUsuario($nombreUsuario)) {
                        // Compruebo si el password es correcto
                        if (comprobarhash($contrasenya, $usuario['contrasenya'])) {
                            // Almacena los datos del usuario en la sesión
                            $_SESSION['idUser'] = $usuario['idUser'];
                            $_SESSION['nombreUsuario'] = $usuario['nombreUsuario'];
                            $_SESSION['nivel_usuario'] = $usuario['nivel_usuario'];
                            $_SESSION['foto_perfil'] = $usuario['foto_perfil'];
                            

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
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../../web/templates/formInicioSesion.php';
    }


    // Función para registrar un usuario nuevo
     public function registro()
     {
         $menu = $this->cargaMenu();

        // Redirigir si el usuario ya está logueado
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
 
             // Validaciones de los datos ingresados
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
                 } catch (Error $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
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

            require __DIR__ . '/../../web/templates/formInsertarComida.php';

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
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
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
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }
    }

    public function buscarPorFecha()
    {
        try {
            $params = array(
                'fecha' => '',
                'comidas' => [],
                'actividades' => [],
            );

            $errores = array();

            if (isset($_POST['bBuscarFecha'])) {
                $fecha = recoge('fecha');

                // Validar la fecha
                unixFechaAAAAMMDD($fecha, "fecha", $errores);

                if (empty($errores)) {
                    $m = new GestionHabitos();
                    $params['comidas'] = $m->obtenerComidasPorFecha($_SESSION['idUser'], $fecha);
                    $params['actividades'] = $m->obtenerActividadesPorFecha($_SESSION['idUser'], $fecha);

                    if (empty($params['comidas']) && empty($params['actividades'])) {
                        $params['mensaje'] = 'No hay registros de comidas o actividades en esta fecha.';
                    }
                } else {
                    $params['mensaje'] = 'Fecha inválida. Revisa el formulario.';
                }

                $params['fecha'] = $fecha;
            }

            require __DIR__ . '/../../web/templates/buscarPorFecha.php';

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }
    }

    // Método para comprobar que el usuario es administrador
    private function verificarAdmin()
    {
        if (!isset($_SESSION['nivel_usuario']) || $_SESSION['nivel_usuario'] != 2) {
            header("Location: index.php?ctl=home");
            exit();
        }
    }

    public function verTodasComidas()
    {
        try {
            $this->verificarAdmin();

            $m = new GestionHabitos();
            $comidas = $m->obtenerTodasComidas();

            $params['comidas'] = $comidas ?: [];
        } catch (Exception $e) {
            error_log($e->getMessage(), 3, "../app/log/logException.txt");
            header('Location: index.php?ctl=error');
            exit();
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/../../web/templates/verTodasComidas.php';
    }

    public function verTodasActividades()
    {
        try {
            $this->verificarAdmin();

            $m = new GestionHabitos();
            $actividades = $m->obtenerTodasActividades();

            $params['actividades'] = $actividades ?: [];
        } catch (Exception $e) {
            error_log($e->getMessage(), 3, "../app/log/logException.txt");
            header('Location: index.php?ctl=error');
            exit();
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/../../web/templates/verTodasActividades.php';
    }

    public function verRecetas()
    {
        try {
            $m = new GestionHabitos();
            $recetas = $m->obtenerRecetas();

            $params = ['recetas' => $recetas];

            require __DIR__ . '/../../web/templates/verRecetas.php';
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }
    }

    public function insertarReceta()
    {
        // Verificar si el usuario tiene permisos de administrador
        if ($_SESSION['nivel_usuario'] != 2) {
            header("location:index.php?ctl=home");
            exit;
        }

        $params = array(
            'titulo' => '', 
            'ingredientes' => '', 
            'instrucciones' => ''
        );

        $errores = [];

        try {
            if (isset($_POST['bInsertarReceta'])) {
                // Recoger los datos del formulario
                $titulo = recoge('titulo');
                $ingredientes = recoge('ingredientes');
                $instrucciones = recoge('instrucciones');
                $imagenes_recetas = gestionarImagenReceta('imagenes_recetas', "imagenes_recetas", $errores);

                // Validaciones
                cTexto($titulo, "Título", $errores);
                cTexto($ingredientes, "Ingredientes", $errores);
                cTexto($instrucciones, "Instrucciones", $errores);

                if (empty($errores)) {
                    $m = new GestionHabitos();
                    if ($m->insertarReceta($titulo, $ingredientes, $instrucciones, $imagenes_recetas)) {
                        header('Location: index.php?ctl=verRecetas');
                        exit;
                    } else {
                        $params['mensaje'] = 'Error al insertar la receta.';
                        $params = array(
                            'titulo' => $titulo, 
                            'ingredientes' => $ingredientes, 
                            'instrucciones' => $instrucciones
                        );
                    }
                } else {
                    $params = array(
                        'titulo' => $titulo, 
                        'ingredientes' => $ingredientes, 
                        'instrucciones' => $instrucciones
                    );
            
                    $params['mensaje'] = 'Revisa los errores en el formulario.';
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/../../web/templates/formInsertarReceta.php';
    }



    

}
?>
