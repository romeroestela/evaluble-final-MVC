<?php

class GestionHabitos extends Modelo {
    
    //Método para insertar un usuario
    public function insertarUsuario($nombre, $apellido, $nombreUsuario, $contrasenya, $foto_perfil = null) {
        
        $foto_perfil = $foto_perfil ?? '/web/imagenes/default_profile.jpg'; // Foto por defecto si no se proporciona
        
        $consulta = "INSERT INTO habitos_saludables.usuarios (nombre, apellido, nombreUsuario, contrasenya, foto_perfil) 
                     VALUES (:nombre, :apellido, :nombreUsuario, :contrasenya, :foto_perfil)";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombre', $nombre);
        $result->bindParam(':apellido', $apellido);
        $result->bindParam(':nombreUsuario', $nombreUsuario);
        $result->bindParam(':contrasenya', $contrasenya);
        $result->bindParam(':foto_perfil', $foto_perfil);
        $result->execute();
        return $result;
    }

    // Consultar usuario por nombre de usuario
    public function consultarUsuario($nombreUsuario) {
        $consulta = "SELECT * FROM habitos_saludables.usuarios WHERE nombreUsuario=:nombreUsuario ";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombreUsuario', $nombreUsuario);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Método para registrar actividad
    public function registrarActividad($idUser, $tipo, $duracion, $calorias, $fecha) {
        $consulta = "INSERT INTO habitos_saludables.actividades (idUser, tipo, duracion, calorias, fecha)
                     VALUES (:idUser, :tipo, :duracion, :calorias, :fecha)";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idUser', $idUser);
        $result->bindParam(':tipo', $tipo);
        $result->bindParam(':duracion', $duracion);
        $result->bindParam(':calorias', $calorias);
        $result->bindParam(':fecha', $fecha);
        $result->execute();
        return $result;
    }

    // Método para registrar comida
    public function insertarComida($idUser, $nombre, $calorias, $foto, $fecha) {
        $consulta = "INSERT INTO habitos_saludables.comidas (idUser, nombre, calorias, foto_comida, fecha)
                     VALUES (:idUser, :nombre, :calorias, :foto_comida, :fecha)";

        // Si no se sube una imagen, se usa la imagen por defecto
        $foto = $foto ?? '/web/imagenes/default_food.jpg';

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idUser', $idUser);
        $result->bindParam(':nombre', $nombre);
        $result->bindParam(':calorias', $calorias);
        $result->bindParam(':foto_comida', $foto);
        $result->bindParam(':fecha', $fecha);
        $result->execute();
        return $result;
    }
    
    public function obtenerComidas($idUser)
    {
        $consulta = "SELECT * FROM habitos_saludables.comidas WHERE idUser = :idUser";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idUser', $idUser);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para registrar avtividades
    public function insertarActividad($idUser, $tipo, $duracion, $calorias, $fecha) {
        $consulta = "INSERT INTO habitos_saludables.actividades (idUser, tipo, duracion, calorias, fecha)
                     VALUES (:idUser, :tipo, :duracion, :calorias, :fecha)";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idUser', $idUser);
        $result->bindParam(':tipo', $tipo);
        $result->bindParam(':duracion', $duracion);
        $result->bindParam(':calorias', $calorias);
        $result->bindParam(':fecha', $fecha);
        $result->execute();
        return $result;
    }
    
    public function obtenerActividades($idUser)
    {
        $consulta = "SELECT * FROM habitos_saludables.actividades WHERE idUser = :idUser";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idUser', $idUser);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener comidas por fecha
    public function obtenerComidasPorFecha($idUser, $fecha)
    {
        $consulta = "SELECT * FROM habitos_saludables.comidas WHERE idUser = :idUser AND fecha = :fecha";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idUser', $idUser);
        $result->bindParam(':fecha', $fecha);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener actividades por fecha
    public function obtenerActividadesPorFecha($idUser, $fecha)
    {
        $consulta = "SELECT * FROM habitos_saludables.actividades WHERE idUser = :idUser AND fecha = :fecha";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idUser', $idUser);
        $result->bindParam(':fecha', $fecha);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todas las comidas de todos los usuarios
    public function obtenerTodasComidas()
    {
        $consulta = "SELECT * FROM habitos_saludables.comidas";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todas las actividades de todos los usuarios
    public function obtenerTodasActividades()
    {
        $consulta = "SELECT * FROM habitos_saludables.actividades";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerRecetas()
    {
        $consulta = "SELECT * FROM habitos_saludables.recetas ORDER BY fecha_publicacion DESC";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertarReceta($titulo, $ingredientes, $instrucciones, $imagenes_recetas)
    {
        $consulta = "INSERT INTO habitos_saludables.recetas (titulo, ingredientes, instrucciones, imagenes_recetas) 
                    VALUES (:titulo, :ingredientes, :instrucciones, :imagenes_recetas)";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':titulo', $titulo);
        $result->bindParam(':ingredientes', $ingredientes);
        $result->bindParam(':instrucciones', $instrucciones);
        $result->bindParam(':imagenes_recetas', $imagenes_recetas);
        
        return $result->execute();
    }


}

?>