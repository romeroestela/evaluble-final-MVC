-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2023 a las 16:43:11
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `habitos_saludables`
-- 
CREATE DATABASE IF NOT EXISTS `habitos_saludables` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `habitos_saludables`;

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
    `idUser` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(100) NOT NULL,
    `apellido` varchar(100) NOT NULL,
    `nombreUsuario` varchar(40) CHARACTER SET utf8 COLLATE, 
    `contrasenya` VARCHAR(255) NOT NULL,
    `nivel_usuario` int(11) NOT NULL DEFAULT 1,
    `foto_perfil` VARCHAR(255) DEFAULT NULL, -- Ruta o URL de la foto de perfil
    PRIMARY KEY (idUser)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
    `idActividad` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `idUser` INT(11) NOT NULL,
    `tipo` VARCHAR(100) NOT NULL,
    `duracion` INT(11) NOT NULL,  -- Duración en minutos
    `calorias` INT(11) NOT NULL,  -- Calorías quemadas
    `fecha` DATE NOT NULL,
    FOREIGN KEY (`idUser`) REFERENCES `usuarios`(`idUser`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `comidas`
--

CREATE TABLE IF NOT EXISTS `comidas` (
    `idComida` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `idUser` INT(11) NOT NULL,
    `nombre` VARCHAR(255) NOT NULL,
    `calorias` INT(11) NOT NULL,  -- Calorías de la comida
    `foto_comida` VARCHAR(255) DEFAULT NULL,  -- Ruta o URL de la foto de la comida
    `fecha` DATE NOT NULL,
    FOREIGN KEY (`idUser`) REFERENCES `usuarios`(`idUser`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

