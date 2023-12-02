-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2022 a las 21:06:09
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `liceoejido`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `alumno_id` int(11) NOT NULL,
  `apellido_alumno` varchar(100) NOT NULL,
  `nombre_alumno` varchar(100) NOT NULL,
  `lugarNac` varchar(100) NOT NULL,
  `entidadFederal` varchar(3) NOT NULL,
  `cedulaes` varchar(20) NOT NULL,
  `sexo` varchar(11) NOT NULL,
  `fecha_nac` date NOT NULL,
  `estadoes` int(11) NOT NULL DEFAULT 1,
  `nacionalidad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`alumno_id`, `apellido_alumno`, `nombre_alumno`, `lugarNac`, `entidadFederal`, `cedulaes`, `sexo`, `fecha_nac`, `estadoes`, `nacionalidad`) VALUES
(24, 'UZCATEGUI RAMIREZ', 'LEONELA ALEJANDRA', 'MERIDA', 'CE', '32148040', 'Femenino', '2007-10-19', 1, 'V-'),
(25, 'DIAZ GUILLEN', 'LUIS DAVID', 'CARACAS', 'CA', '27777409', 'Masculino', '2008-09-17', 1, 'V-'),
(26, 'PEREZ ANGULO', 'JOSE JOSE', 'BOGOTA', 'BO', '80257893', 'Masculino', '2004-06-27', 1, 'E-'),
(27, 'PEÑA CALDERON', 'AARON JOIFIEL', 'CARACAS', 'CA', '29634519', 'Masculino', '2002-11-22', 1, 'V-'),
(28, 'OSORIO', 'SARAIT', 'MERIDA', 'ME', '20849034', 'Femenino', '2005-11-18', 1, 'V-'),
(29, 'MENDEZ', 'DANIEL', 'MERIDA', 'ME', '32198883', 'Masculino', '2015-01-31', 1, 'V-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `aula_id` int(11) NOT NULL,
  `nombre_aula` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`aula_id`, `nombre_aula`, `estado`) VALUES
(13, 'A', 1),
(14, 'B', 1),
(15, 'C', 1),
(16, 'D', 1),
(17, 'E', 1),
(19, 'F', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuarto_año`
--

CREATE TABLE `cuarto_año` (
  `cuarto_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `numero_lista` int(2) NOT NULL DEFAULT 0,
  `statuscr` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuarto_año`
--

INSERT INTO `cuarto_año` (`cuarto_id`, `alumno_id`, `aula_id`, `periodo_id`, `numero_lista`, `statuscr`) VALUES
(1, 29, 13, 9, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `materia_id` int(11) NOT NULL,
  `nombre_materia` varchar(50) NOT NULL,
  `siglas` text NOT NULL,
  `año_seleccion` int(1) DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`materia_id`, `nombre_materia`, `siglas`, `año_seleccion`, `estado`) VALUES
(22, 'ARTE Y PATRIMONIO', 'AP', 1, 0),
(23, 'CASTELLANO', 'CA', 1, 1),
(24, 'ORIENTACION Y CONVIVENCIA', 'OC', 1, 0),
(25, 'PARTICIPACION EN GRUPOS', 'PG', 1, 0),
(26, 'ORIENTACION Y CONVIVENCIA', 'OC', 2, 0),
(27, 'ORIENTACION Y CONVIVENCIA', 'OC', 3, 0),
(28, 'PARTICIPACION EN GRUPOS', 'PG', 2, 0),
(29, 'INGLES Y OTRAS LENGUAS  EXTRANJERAS', 'IG', 1, 1),
(30, 'MATEMATICAS', 'MA', 1, 1),
(31, 'EDUCACION FISICA', 'EF', 1, 1),
(32, 'ARTE Y PATRIMONIO', 'AP', 1, 1),
(33, 'CIENCIAS NATURALES', 'CN', 1, 1),
(34, 'GEOGRAFIA, HISTORIA Y CIUDADANIA', 'GH', 1, 1),
(35, 'ORIENTACION Y CONVIVENCIA', 'OC', 1, 1),
(36, 'PARTICIPACION EN GRUPOS', 'PG', 1, 1),
(37, 'CASTTELLANO', 'CA', 5, 1),
(38, 'INGLES Y OTRAS LENGUAS  EXTRANJERAS', 'IG', 5, 1),
(39, 'MATEMATICAS', 'MA', 5, 1),
(40, 'EDUCACION FISICA', 'EF', 5, 1),
(41, 'FISICA', 'FI', 5, 1),
(42, 'QUIMICA', 'QI', 5, 1),
(43, 'CIENCIAS DE LA TIERRA', 'CT', 5, 1),
(44, 'GEOGRAFIA, HISTORIA Y CIUDADANIA', 'GH', 5, 1),
(45, 'FORMACION PARA LA SOBERANIA NACIONAL', 'FS', 5, 1),
(46, 'ORIENTACION Y CONVIVENCIA', 'OC', 5, 1),
(47, 'PARTICIPACION EN GRUPOS', 'PG', 5, 1),
(48, 'CASTELLANO', 'CA', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `nota_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `nota1` int(2) NOT NULL DEFAULT 0,
  `nota2` int(2) NOT NULL DEFAULT 0,
  `nota3` int(2) NOT NULL DEFAULT 0,
  `periodo_id` int(11) NOT NULL,
  `promedio` int(2) NOT NULL DEFAULT 0,
  `curso` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`nota_id`, `alumno_id`, `materia_id`, `nota1`, `nota2`, `nota3`, `periodo_id`, `promedio`, `curso`) VALUES
(47, 24, 23, 10, 14, 15, 6, 13, 1),
(48, 24, 29, 11, 17, 17, 6, 15, 1),
(49, 24, 30, 15, 16, 9, 6, 13, 1),
(50, 24, 31, 14, 13, 16, 6, 14, 1),
(51, 27, 37, 6, 6, 5, 6, 6, 5),
(52, 27, 38, 10, 19, 18, 6, 16, 5),
(53, 27, 39, 1, 20, 18, 6, 13, 5),
(54, 27, 40, 11, 18, 5, 6, 11, 5),
(55, 27, 41, 12, 18, 13, 6, 14, 5),
(56, 27, 42, 15, 11, 16, 6, 14, 5),
(57, 27, 43, 14, 14, 10, 6, 13, 5),
(58, 27, 44, 15, 10, 17, 6, 14, 5),
(59, 27, 45, 14, 17, 17, 6, 16, 5),
(60, 27, 46, 19, 18, 12, 6, 16, 5),
(61, 27, 47, 15, 17, 16, 6, 16, 5),
(62, 28, 23, 13, 15, 16, 6, 15, 1),
(63, 28, 29, 8, 16, 12, 6, 12, 1),
(64, 28, 30, 15, 14, 17, 6, 15, 1),
(65, 28, 31, 15, 16, 12, 6, 14, 1),
(66, 28, 32, 13, 16, 16, 6, 15, 1),
(67, 28, 33, 12, 15, 15, 6, 14, 1),
(68, 28, 34, 13, 17, 18, 6, 16, 1),
(69, 28, 35, 14, 17, 20, 6, 17, 1),
(70, 28, 36, 15, 18, 19, 6, 17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `periodo_id` int(11) NOT NULL,
  `nombre_periodo` varchar(11) NOT NULL DEFAULT '2020-2021',
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`periodo_id`, `nombre_periodo`, `estado`) VALUES
(6, '2020-2021', 2),
(7, '2021-2022', 2),
(9, '2022-2023', 1),
(10, '2023-2024', 2),
(11, '2024-2025', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `primer_año`
--

CREATE TABLE `primer_año` (
  `primero_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `numero_lista` int(2) NOT NULL DEFAULT 0,
  `statuspr` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `primer_año`
--

INSERT INTO `primer_año` (`primero_id`, `alumno_id`, `aula_id`, `periodo_id`, `numero_lista`, `statuspr`) VALUES
(2, 24, 13, 9, 1, 1),
(3, 28, 13, 6, 2, 1),
(4, 25, 14, 9, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `profesor_id` int(11) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `estadopr` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`profesor_id`, `apellido`, `nombre`, `cedula`, `estadopr`) VALUES
(4, 'Diaz', 'Luis ', '123456789', 1),
(5, 'Ramírez ', 'Jorge ', '131313', 1),
(6, 'Guillen', 'Nilba', '151515', 1),
(7, 'Ganzua', 'Tocamela', '90398', 1),
(8, 'Coco', 'Sete', '209903', 0),
(9, 'ASD', 'ASD', '21333333333333333333', 0),
(10, 'CEDULA', 'RARA', '23333333333333333333', 0),
(11, 'CEDULA', 'RARA', '2.2222222222222E+37', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quinto_año`
--

CREATE TABLE `quinto_año` (
  `quinto_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `numero_lista` int(2) NOT NULL DEFAULT 0,
  `statusqn` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `quinto_año`
--

INSERT INTO `quinto_año` (`quinto_id`, `alumno_id`, `aula_id`, `periodo_id`, `numero_lista`, `statusqn`) VALUES
(1, 27, 15, 6, 29, 1),
(2, 28, 13, 9, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `reporte_id` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Asistente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segundo_año`
--

CREATE TABLE `segundo_año` (
  `segundo_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `numero_lista` int(2) NOT NULL DEFAULT 0,
  `statussg` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `segundo_año`
--

INSERT INTO `segundo_año` (`segundo_id`, `alumno_id`, `aula_id`, `periodo_id`, `numero_lista`, `statussg`) VALUES
(1, 28, 13, 9, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tercer_año`
--

CREATE TABLE `tercer_año` (
  `tercer_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `numero_lista` int(2) NOT NULL DEFAULT 0,
  `statustr` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tercer_año`
--

INSERT INTO `tercer_año` (`tercer_id`, `alumno_id`, `aula_id`, `periodo_id`, `numero_lista`, `statustr`) VALUES
(1, 26, 13, 9, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `usuario`, `clave`, `rol`, `estado`) VALUES
(1, 'Luis Diaz', 'admin', '$2y$10$umiy/n/WfT4BITO455EQzeuQphiSqlRk2DSJHj9rfAxzRnXvPEuKq', 1, 1),
(2, 'Jesus Mireles', 'jesus1', '$2y$10$jCtsfOfFwiKBwKvESViukuA0YSg4W3MbZIJTQNmDx.au2EqDXBtv.', 2, 0),
(3, 'Alina', 'ali9', '$2y$10$Ro8aMxK3f/XzHDoTSjZoBej1yHxcPfxgpTrlmrgleyQdMsvyg.LlO', 1, 2),
(4, 'Jorge Ramírez ', 'jorge', '$2y$10$uQNpjzZY.Y57gYEKT94mK.02EAQGdgXT6KQbpSbxmS7WydunOIOg2', 2, 1),
(5, 'Angela Calderon', 'angela', '$2y$10$d25gnp/tSfOIZD6AWXfqluIFQL2Y1R/HyR4FZpVCO4IVe6u8vis2K', 2, 1),
(6, 'Francisco Mendez', 'francisco', '$2y$10$Tp3C.lLw37kpWf6LdulJ3uilEWgu6qhGKErKuzIRczCT4yAWZI85m', 2, 1),
(7, 'Zoraima Peña', 'zora', '$2y$10$2nnddU6AZ0Wy722Ws2Uv.OrMUkKDVcqpdFqe8CKzzTzJuQyrXvtVS', 1, 1),
(8, 'JAZMIN', 'jazmin', '$2y$10$VlRIuNZSHubPgxVBa/L9nONDj3g2ymTpaaReB9/jWoq4PRzxevn2.', 1, 1),
(9, 'LO', 'que', '$2y$10$UdjxWITiWQyE7laKEC4B0ubDF3nrPEHiQZ.YxDw9j3KWNPCEqVPZe', 1, 1),
(10, 'NONO', 'nano', '$2y$10$3zn8FMvN8Nm1eOzrEeJhaezeKx9I/XW/lwsSXFifaQdbURT8vYDhe', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`alumno_id`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`aula_id`);

--
-- Indices de la tabla `cuarto_año`
--
ALTER TABLE `cuarto_año`
  ADD PRIMARY KEY (`cuarto_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`materia_id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`nota_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`periodo_id`);

--
-- Indices de la tabla `primer_año`
--
ALTER TABLE `primer_año`
  ADD PRIMARY KEY (`primero_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`profesor_id`);

--
-- Indices de la tabla `quinto_año`
--
ALTER TABLE `quinto_año`
  ADD PRIMARY KEY (`quinto_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`reporte_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `segundo_año`
--
ALTER TABLE `segundo_año`
  ADD PRIMARY KEY (`segundo_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `tercer_año`
--
ALTER TABLE `tercer_año`
  ADD PRIMARY KEY (`tercer_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `alumno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `aula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `cuarto_año`
--
ALTER TABLE `cuarto_año`
  MODIFY `cuarto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `materia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `nota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `periodo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `primer_año`
--
ALTER TABLE `primer_año`
  MODIFY `primero_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `profesor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `quinto_año`
--
ALTER TABLE `quinto_año`
  MODIFY `quinto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `reporte_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `segundo_año`
--
ALTER TABLE `segundo_año`
  MODIFY `segundo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tercer_año`
--
ALTER TABLE `tercer_año`
  MODIFY `tercer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuarto_año`
--
ALTER TABLE `cuarto_año`
  ADD CONSTRAINT `cuarto_año_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuarto_año_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuarto_año_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_4` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `primer_año`
--
ALTER TABLE `primer_año`
  ADD CONSTRAINT `primer_año_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `primer_año_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `primer_año_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `quinto_año`
--
ALTER TABLE `quinto_año`
  ADD CONSTRAINT `quinto_año_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quinto_año_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quinto_año_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `segundo_año`
--
ALTER TABLE `segundo_año`
  ADD CONSTRAINT `segundo_año_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `segundo_año_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `segundo_año_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tercer_año`
--
ALTER TABLE `tercer_año`
  ADD CONSTRAINT `tercer_año_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tercer_año_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tercer_año_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
