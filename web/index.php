<?php

require_once __DIR__ . '/../app/libs/config.php';
require_once __DIR__ . '/../app/libs/bGeneral.php';
require_once __DIR__ . '/../app/libs/bSeguridad.php';
require_once __DIR__ . '/../app/modelo/classModelo.php';
require_once __DIR__ . '/../app/modelo/classGestionHabitos.php';
require_once __DIR__ . '/../app/controlador/Controller.php';

session_start();

// Definir rutas y permisos
$map = array(
    'home' => array('controller' => 'Controller', 'action' => 'home', 'nivel_usuario' => 0),
    'inicio' => array('controller' => 'Controller', 'action' => 'inicio', 'nivel_usuario' => 0),
    'registro' => array('controller' => 'Controller', 'action' => 'registro', 'nivel_usuario' => 0),
    'iniciarSesion' => array('controller' => 'Controller', 'action' => 'iniciarSesion', 'nivel_usuario' => 0),
    'salir' => array('controller' => 'Controller', 'action' => 'salir', 'nivel_usuario' => 1),
    'error' => array('controller' => 'Controller', 'action' => 'error', 'nivel_usuario' => 0),
    'insertarComida' => array('controller' => 'Controller', 'action' => 'insertarComida', 'nivel_usuario' => 1),
    'insertarActividad' => array('controller' => 'Controller', 'action' => 'insertarActividad', 'nivel_usuario' => 1),
    'verActividades' => array('controller' => 'Controller', 'action' => 'verActividades', 'nivel_usuario' => 1),
    'verComidas' => array('controller' => 'Controller', 'action' => 'verComidas', 'nivel_usuario' => 1),
    'buscarPorFecha' => array('controller' => 'Controller', 'action' => 'buscarPorFecha', 'nivel_usuario' => 1),
    'verTodasComidas' => array('controller' => 'Controller', 'action' => 'verTodasComidas', 'nivel_usuario' => 2),
    'verTodasActividades' => array('controller' => 'Controller', 'action' => 'verTodasActividades', 'nivel_usuario' => 2),
    'verRecetas' => array('controller' => 'Controller', 'action' => 'verRecetas', 'nivel_usuario' => 0),
    'insertarReceta' => array('controller' => 'Controller', 'action' => 'insertarReceta', 'nivel_usuario' => 2)
);

// Obtener la ruta de la URL (?ctl=...)
if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        $ruta = $_GET['ctl'];
    } else {

        //Si el valor puesto en ctl en la URL no existe en el array de mapeo envía una cabecera de error
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' .
            $_GET['ctl'] . '</p></body></html>';
        exit;
    
    }
} else {
    $ruta = 'home';
}
$controlador = $map[$ruta];

// Ejecutar la acción del controlador
if (method_exists($controlador['controller'], $controlador['action'])) {
    if (!isset($_SESSION['nivel_usuario'])) {
        $_SESSION['nivel_usuario'] = 0; // Usuario invitado por defecto
    }

    if ($controlador['nivel_usuario'] <= $_SESSION['nivel_usuario']) {
        call_user_func(array(
            new $controlador['controller'],
            $controlador['action']
        ));
    }else{
        call_user_func(array(
            new $controlador['controller'],
            'inicio'
        )); 
    }
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
        $controlador['controller'] .
        '->' .
        $controlador['action'] .
        '</i> no existe</h1></body></html>';
    echo ("entrarErrorInicio");
}
?>


