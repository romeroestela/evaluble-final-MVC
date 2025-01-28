<?php

class Modelo extends PDO {

    protected $conexion;

    public function __construct() {
        $this->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . ';port=' . Config::$mvc_bd_port . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
        // En los ejemplos no se añade `';port=' . Config::$mvc_bd_port`, como he explicado en `config.php` y si no lo cambio no conecta bien la base de datos
        $this->conexion->exec("set names utf8");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
?>