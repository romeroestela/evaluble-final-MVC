<?php

class Config {
    public static $mvc_bd_hostname = "localhost";
    public static $mvc_bd_nombre = "habitos_saludables";
    public static $mvc_bd_usuario = "root";
    public static $mvc_bd_clave = "";
    public static $mvc_vis_css = "estilo.css";
    public static $mvc_bd_port = "3309"; // He añadido esta línea porque en mi caso el puerto es diferente y es necesario configurarlo.
 
    /*public static $vista = __DIR__ . '/../templates/';
    public static $menu = __DIR__ . '/../templates/';*/
}
?>