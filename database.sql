-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2021 a las 12:37:54
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `descripcion_cargo` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `descripcion_cargo`) VALUES
(14, 'Administrador de base de datos'),
(3, 'analista de pruebas'),
(1, 'analista funcional'),
(2, 'arquitecto de soluciones'),
(16, 'Dealer a tiempo completo'),
(15, 'Desarrollador Angular'),
(12, 'ingeniero industrial'),
(13, 'ingeniero químico'),
(6, 'Instructor de ingles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `numero_documento` int(20) NOT NULL,
  `nombre_empresa` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono_empresa` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `id_tipo_documento`, `numero_documento`, `nombre_empresa`, `correo`, `telefono_empresa`) VALUES
(7000, 9951, 50502020, 'ecomoda', 'santi@monsa.com', 3183297055),
(7001, 9951, 20205050, 'ebs', 'santi@pruebas.iso', 3183297050),
(7003, 9952, 79444056, 'EcoPlaza S.A.S', 'ecoplaza@outlook.com', 3183297055),
(7004, 9951, 51981212, 'Laravel PHP', 'laravel@development.com', 3145267489),
(7008, 9952, 5198121, 'Andres Monsalve', 'asmonsalves@correo.ud.com', 3183297055),
(7009, 9952, 30202040, 'Michoacan', 'mail@index.com', 3877474),
(7011, 9950, 20201010, 'mis cosas', 'mail@mail.com.es', 3877470),
(7012, 9952, 30201040, 'mas pruebas', 'sirve@ojala.co', 3877474),
(7013, 9951, 9912225, 'intergrupo', 'pruebas@intergrupo.com', 3877474),
(7014, 9952, 123456789, 'SO', 'so@so.com', 3544141);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `numero_documento` int(11) DEFAULT NULL,
  `nombre1` varchar(50) NOT NULL,
  `nombre2` varchar(50) DEFAULT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `correo` varchar(75) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `id_tipo_documento`, `id_cargo`, `id_empresa`, `numero_documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `correo`, `fecha_nacimiento`) VALUES
(10000, 9950, 1, 7001, 1073528769, 'andres', 'santiago', 'monsalve', 'salinas', 'santi@pruebas.wab', '2021-06-01'),
(10001, 9950, 2, 7000, 1073528766, 'daniel', 'arturo', 'monsalve', 'salinas', 'santi@monsa.com', '2021-06-13'),
(10007, 9950, 2, 7001, 1073568947, 'santiago', 'andres', 'orduz', 'perez', 'santi@pruebas.iso', '2021-06-12'),
(10011, 9950, 15, 7003, 79444052, 'andres', 'santiago', 'monsalce', 'salinas', 'ecoplaza@outlook.iso', '1999-12-22'),
(10012, 9950, 13, 7004, 79444055, 'rafael', 'arturo', 'monsalve', 'salinas', 'laravel@development.com.es', '1970-12-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL,
  `tipo_documento` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_documento`, `tipo_documento`) VALUES
(9950, 'CC'),
(9953, 'CE'),
(9951, 'NIT'),
(9954, 'PA'),
(9952, 'RUT');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`),
  ADD UNIQUE KEY `descripcion_cargo` (`descripcion_cargo`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD UNIQUE KEY `numero_documento` (`numero_documento`),
  ADD KEY `id_tipo_documento` (`id_tipo_documento`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `numero_documento` (`numero_documento`),
  ADD KEY `id_tipo_documento` (`id_tipo_documento`),
  ADD KEY `id_cargo` (`id_cargo`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipo_documento`),
  ADD UNIQUE KEY `tipo_documento` (`tipo_documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7015;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10013;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9955;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documento` (`id_tipo_documento`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documento` (`id_tipo_documento`),
  ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`),
  ADD CONSTRAINT `persona_ibfk_3` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
