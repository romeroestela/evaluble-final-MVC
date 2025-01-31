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

}

?>