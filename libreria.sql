-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 03:06:04
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `ID_Compra` int(11) NOT NULL,
  `Fecha_compra` date NOT NULL,
  `Total` double NOT NULL,
  `Local` varchar(50) NOT NULL,
  `ID_Libro` int(11) NOT NULL,
  `ID_Cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`ID_Compra`, `Fecha_compra`, `Total`, `Local`, `ID_Libro`, `ID_Cliente`) VALUES
(1, '2024-10-18', 19.99, 'Toledo', 1, 2),
(3, '2024-10-16', 12.75, 'San Bernardo', 3, 5),
(4, '2024-10-20', 10, 'Toledo', 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `ID_Libro` int(11) NOT NULL,
  `Titulo` varchar(50) NOT NULL,
  `Autor` varchar(50) NOT NULL,
  `Genero` varchar(250) NOT NULL,
  `Editorial` varchar(50) NOT NULL,
  `Precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`ID_Libro`, `Titulo`, `Autor`, `Genero`, `Editorial`, `Precio`) VALUES
(1, 'El Jardín de los Secretos', 'Lucía Pérez', 'Fantasía', 'Editorial Aurora', 19.99),
(2, 'Sombras del Pasado', 'Miguel Álvarez', 'Suspenso', 'Ediciones Centauro', 15.5),
(3, 'Huellas en la Arena', 'Carla Gómez', 'Romance', 'Editorial Cumbre', 12.75),
(4, 'El Último Guerrero', 'Javier Morales', 'Aventura', 'Publicaciones Fénix', 22.4),
(5, 'Voces en el Viento', 'Mariana Torres', 'Poesía', 'Editorial Eterna', 10),
(16, 'La Luna Roja', 'Sofía Herrera', 'Ciencia Ficción', 'Editorial Solaris', 18.9),
(17, 'El Eco de las Montañas', 'Fernando Díaz', 'Aventura', 'Ediciones Alpina', 20.3),
(18, 'Reflejos del Alma', 'Paula Martínez', 'Drama', 'Editorial Horizonte', 13.8),
(19, 'El Guardián del Tiempo', 'Ricardo Castillo', 'Fantasía', 'Editorial Estelar', 24.99),
(20, 'Caminos Inexplorados', 'Ana Beltrán', 'Viajes', 'Ediciones Mundus', 16.45),
(21, 'El Susurro del Bosque', 'Juan Romero', 'Terror', 'Publicaciones Nocturna', 14.6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `es_admin` varchar(60) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre`, `Password`, `es_admin`) VALUES
(1, 'webadmin', '$2y$10$jWQVRTbh1CVWv/ocIhTW8eYWAdiFrMFbVF4BG.YJSiYJlTClNCUl.', 'admin'),
(2, 'Carlos Rodriguez', '12345', '0'),
(3, 'Claudia Luit', '4567', '0'),
(4, 'juan.perez', '12345', '0'),
(5, 'maria.lopez', 'abcd123', '0'),
(6, 'carlos.gomez', 'qwerty456', '0'),
(7, 'ana.fernandez', 'pass789', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`ID_Compra`),
  ADD KEY `ID_Libro` (`ID_Libro`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`ID_Libro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `ID_Compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `ID_Libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`ID_Libro`) REFERENCES `libros` (`ID_Libro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
