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

CREATE TABLE `usuarios` (
  `idUser` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `nombreUsuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `contrasenya` varchar(256) NOT NULL,
  `nivel_usuario` int(11) NOT NULL DEFAULT 1,
  `foto_perfil` VARCHAR(255) DEFAULT NULL -- Ruta o URL de la foto de perfil
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `uk_nombreUsuario` (`nombreUsuario`);

ALTER TABLE `usuarios`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
    `idActividad` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `idUser` int(11) NOT NULL,
    `tipo` varchar(100) NOT NULL,
    `duracion` int(11) NOT NULL,  -- Duración en minutos
    `calorias` int(11) NOT NULL,  -- Calorías quemadas
    `fecha` DATE NOT NULL,
    FOREIGN KEY (`idUser`) REFERENCES `usuarios`(`idUser`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `comidas`
--

CREATE TABLE `comidas` (
    `idComida` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `idUser` int(11) NOT NULL,
    `nombre` varchar(255) NOT NULL,
    `calorias` int(11) NOT NULL,  -- Calorías de la comida
    `foto_comida` varchar(255) DEFAULT NULL,  -- Ruta o URL de la foto de la comida
    `fecha` date NOT NULL,
    FOREIGN KEY (`idUser`) REFERENCES `usuarios`(`idUser`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

