-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2024 a las 21:11:30
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

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
  `municipio` varchar(20) NOT NULL DEFAULT 'LIBERTADOR',
  `cedulaes` bigint(20) NOT NULL,
  `sexo` varchar(11) NOT NULL,
  `fecha_nac` date NOT NULL,
  `estadoes` int(11) NOT NULL DEFAULT 1,
  `nacionalidad` text NOT NULL,
  `cedu_estudiantil` bigint(18) NOT NULL DEFAULT 12345678910,
  `telefono_contacto` varchar(30) NOT NULL DEFAULT 'NULL',
  `direccion_vivienda` varchar(100) NOT NULL DEFAULT 'NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`alumno_id`, `apellido_alumno`, `nombre_alumno`, `lugarNac`, `entidadFederal`, `municipio`, `cedulaes`, `sexo`, `fecha_nac`, `estadoes`, `nacionalidad`, `cedu_estudiantil`, `telefono_contacto`, `direccion_vivienda`) VALUES
(1, 'DIAZ GUILLEN', 'JAMON DE PAVO', 'MERIDA', 'ME', 'LIBERTADOR', 27777409, 'M', '2010-06-27', 0, 'V-', 12345678910, '04168746717', 'MOLINA'),
(2, 'DIAZ GUILLEN', 'PARTICIPACION EN GRUPOS', 'MERIDA', 'ME', 'LIBERTADOR', 27777409, 'M', '2010-06-27', 0, 'E-', 12345678910, '04121234567', 'NULL'),
(3, 'DIAZ GUILLEN', 'JAMON DE PAVO', 'MERIDA', 'ME', 'LIBERTADO', 27777403, 'M', '2007-02-10', 1, 'V-', 12345678911, '04121234555', 'PORTACHUELO'),
(4, 'GUTIERREZ HERNANDEZ', 'ELIANI MICHELL', 'MERIDA', 'ME', 'LIBERTADOR', 32851404, 'F', '2011-05-12', 1, 'V-', 12345678910, '04121234567', 'NULL'),
(5, 'MOLINA MENDEZ', 'THATIANA ESTEFANIA', 'ZULIA', 'ZU', 'LIBERTADOR', 32941291, 'F', '2010-03-28', 1, 'V-', 12345678910, '04121234567', 'NULL'),
(6, 'CHACON ZAMBRANO', 'ROMIRO ALBERTO', 'MERIDA', 'ME', 'LIBERTADOR', 33324358, 'M', '2007-12-21', 1, 'V-', 12345678922, '04121234567', 'NULL'),
(7, 'ALUMNO DE LA B', 'PRUEBA', 'PIÑA DEBAJO DEL MAR', 'ME', 'LIBERTADOR', 27777777, 'M', '2009-12-20', 1, 'V-', 12345678910, '04121234567', 'NULL'),
(8, 'ROJAS MANRIQUE', 'JESUS GRABIEL', 'MERIDA', 'ME', 'LIBERTADOR', 32581113, 'M', '2012-12-20', 1, 'V-', 12345678910, '04121234567', 'NULL'),
(9, 'ALKSDJ', 'ASDASD', 'ASDASD', 'AS', 'LIBERTADOR', 27777419, 'M', '2011-06-13', 1, 'V-', 1231231231, '04121234567', 'NULL'),
(10, 'ASDASDASD', 'ASDASDASD', 'ASDASDASD', 'AS', 'LIBERTADOR', 28888409, 'M', '2015-06-27', 1, 'V-', 288884090, '04121234567', 'NULL'),
(11, 'SUAREZ', 'INES ', 'MERIDA', 'ME', 'LIBERTADOR', 263731941, 'F', '2008-10-20', 1, 'V-', 26373401, '04121234567', 'NULL'),
(12, 'DIAZ GUIL', 'LUIS D', 'MERIDA', 'ME', 'LIBERTADOR', 27777449, 'M', '2012-07-27', 1, 'V-', 277774491, 'NULL', 'NULL'),
(13, 'SUAREZ', 'INES ', 'ASDASD', 'ME', 'LIBERTADOR', 27777409, 'M', '2012-07-27', 1, 'V-', 277774493, '04168746717', 'PABLO CHACON'),
(14, 'DIAZ GUILLEN', 'LUIS DAVID', 'MERIDA', 'ME', 'LIBERTADOR', 29777409, 'M', '2015-06-27', 1, 'V-', 1277774090, '04168716717', 'EJIDO, LA MESA, CALLE PIÑANGO CASA NÚMERO 6'),
(15, 'SOSA', 'EMMA', 'MERIDA', 'ME', 'EJIDO', 30123456, 'F', '2017-01-12', 1, 'V-', 301234561, '04121231231', 'EJIDO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `aula_id` int(11) NOT NULL,
  `nombre_aula` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`aula_id`, `nombre_aula`, `estado`) VALUES
(1, 'A', 1),
(2, 'B', 1),
(3, 'C', 1),
(4, 'D', 1),
(5, 'E', 2);

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
  `statuscr` int(11) NOT NULL DEFAULT 1,
  `grupo_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuarto_año`
--

INSERT INTO `cuarto_año` (`cuarto_id`, `alumno_id`, `aula_id`, `periodo_id`, `numero_lista`, `statuscr`, `grupo_id`) VALUES
(1, 3, 1, 1, 1, 2, 2),
(2, 14, 1, 4, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_liceo`
--

CREATE TABLE `datos_liceo` (
  `id_liceo` int(1) NOT NULL,
  `nombre_liceo` varchar(100) NOT NULL,
  `zonaedu_liceo` varchar(10) NOT NULL,
  `entidad_liceo` varchar(20) NOT NULL,
  `ef_liceo` varchar(3) NOT NULL,
  `municipio_liceo` varchar(20) NOT NULL,
  `direccion_liceo` varchar(150) NOT NULL,
  `telefono_liceo` varchar(20) NOT NULL,
  `nacionalidad_director` varchar(3) NOT NULL DEFAULT 'V',
  `cedula_director` int(15) NOT NULL DEFAULT 14832319,
  `nombre_director` varchar(20) NOT NULL,
  `apellido_director` varchar(20) NOT NULL,
  `código_liceo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_liceo`
--

INSERT INTO `datos_liceo` (`id_liceo`, `nombre_liceo`, `zonaedu_liceo`, `entidad_liceo`, `ef_liceo`, `municipio_liceo`, `direccion_liceo`, `telefono_liceo`, `nacionalidad_director`, `cedula_director`, `nombre_director`, `apellido_director`, `código_liceo`) VALUES
(1, 'LICEO BOLIVARIANO EJIDO', '14', 'MÉRIDA', 'ME', 'CAMPO ELIAS', 'AV. 25 DE NOVIEMBRE VÍA MANZANO ALTO- EJIDO', '0274-2217237', 'V', 14832319, 'ZULAY', 'DÁVILA', 'S0718D1406');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas`
--

CREATE TABLE `estadisticas` (
  `id_estadisticas` int(11) NOT NULL,
  `primerAño` varchar(200) NOT NULL,
  `segundoAño` varchar(200) NOT NULL,
  `tercerAño` varchar(200) NOT NULL,
  `cuartoAño` varchar(200) NOT NULL,
  `quintoAño` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticas`
--

INSERT INTO `estadisticas` (`id_estadisticas`, `primerAño`, `segundoAño`, `tercerAño`, `cuartoAño`, `quintoAño`) VALUES
(1, '11', '11', '11', '11', '11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `grupo_id` int(11) NOT NULL,
  `nombre_grupo` varchar(30) NOT NULL,
  `estado_grupos` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`grupo_id`, `nombre_grupo`, `estado_grupos`) VALUES
(1, 'FUTBOL SALA', 0),
(2, 'FUTBOL CAMPO', 1),
(3, 'NATACIÓN', 1),
(4, 'TENIS', 1),
(5, 'MUSICA', 1),
(6, 'SAD', 0),
(7, 'INFORMÁTICA', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`materia_id`, `nombre_materia`, `siglas`, `año_seleccion`, `estado`) VALUES
(1, 'CASTELLANO', 'CA', 1, 1),
(2, 'INGLES Y OTRAS LENGUAS EXTRANJERAS', 'ILE', 1, 1),
(3, 'MATEMÁTICAS', 'MA', 1, 1),
(4, 'PARTICIPACION EN GRUPOS', 'GP', 1, 0),
(5, 'ORIENTACION Y CONVIVENCIA', 'OYC', 1, 0),
(6, 'EDUCACION FISICA', 'EF', 1, 1),
(7, 'ARTE Y PATRIMONIO', 'AP', 1, 1),
(8, 'CIENCIAS NATURALES', 'CN', 1, 1),
(9, 'GEOGRAFÍA, HISTORIA Y CIUDADANÍA', 'GHC', 1, 1),
(10, 'CASTELLANO', 'CA', 2, 1),
(11, 'INGLÉS Y OTRAS LENGUAS EXTRANJERAS', 'ILE', 2, 1),
(12, 'MATEMÁTICAS', 'MA', 2, 1),
(13, 'EDUCACIÓN FÍSICA', 'EF', 2, 1),
(14, 'ARTE Y PATRIMONIO', 'AP', 2, 1),
(15, 'CIENCIAS NATURALES', 'CN', 2, 1),
(16, 'GEOGRAFÍA, HISTORIA Y CIUDADANÍA', 'GHC', 2, 1),
(17, 'CASTELLANO', 'CA', 3, 1),
(18, 'INGLÉS Y OTRAS LENGUAS EXTRANJERAS', 'ILE', 3, 1),
(19, 'MATEMÁTICAS', 'MA', 3, 1),
(20, 'EDUCACIÓN FÍSICA', 'EF', 3, 1),
(21, 'FÍSICA', 'FI', 3, 1),
(22, 'QUÍMICA', 'QM', 3, 1),
(23, 'BIOLOGÍA', 'BI', 3, 1),
(24, 'ORIENTACIÓN Y CONVIVENCIA', 'OYC', 1, 0),
(25, 'ORIENTACIÓN Y CONVIVENCIA', 'OYC', 1, 1),
(26, 'PARTICIPACION EN GRUPOS', 'GP', 1, 1),
(27, 'GEOGRAFÍA, HISTORIA Y CIUDADANÍA', 'GHC', 3, 1),
(28, 'CASTELLANO', 'CA', 4, 1),
(29, 'INGLÉS Y OTRAS LENGUAS EXTRANJERAS', 'ILE', 4, 1),
(30, 'MATEMÁTICAS', 'MA', 4, 1),
(31, 'EDUCACIÓN FÍSICA', 'EF', 4, 1),
(32, 'FÍSICA', 'FI', 4, 1),
(33, 'QUÍMICA', 'QM', 4, 1),
(34, 'BIOLOGÍA', 'BI', 1, 0),
(35, 'BIOLOGÍA', 'BI', 4, 1),
(36, 'GEOGRAFÍA, HISTORIA Y CIUDADANÍA', 'GHC', 4, 1),
(37, 'FORMACIÓN PARA LA SOBERANÍA NACIONAL', 'FSN', 4, 1),
(38, 'CASTELLANO', 'CA', 5, 1),
(39, 'INGLÉS Y OTRAS LENGUAS EXTRANJERAS', 'ILE', 5, 1),
(40, 'MATEMÁTICAS', 'MA', 5, 1),
(41, 'EDUCACIÓN FÍSICA', 'EF', 5, 1),
(42, 'FÍSICA', 'FI', 5, 1),
(43, 'QUÍMICA', 'QM', 5, 1),
(44, 'FORMACIÓN PARA LA SOBERANÍA NACIONAL', 'FSN', 5, 1),
(45, 'ORIENTACIÓN Y CONVIVENCIA', 'OYC', 2, 1),
(46, 'GRUPOS DE PARTICIPACIÓN', 'GP', 2, 1),
(47, 'ORIENTACIÓN Y CONVIVENCIA', 'OYC', 3, 1),
(48, 'ORIENTACIÓN Y CONVIVENCIA', 'OYC', 4, 1),
(49, 'ORIENTACIÓN Y CONVIVENCIA', 'OYC', 5, 1),
(50, 'GRUPOS DE PARTICIPACIÓN', 'GP', 3, 1),
(51, 'GRUPOS DE PARTICIPACIÓN', 'GP', 4, 1),
(52, 'GRUPOS DE PARTICIPACIÓN', 'GP', 5, 1);

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
  `curso` int(11) NOT NULL DEFAULT 1,
  `estadonota` int(2) NOT NULL DEFAULT 2,
  `momento_nota` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`nota_id`, `alumno_id`, `materia_id`, `nota1`, `nota2`, `nota3`, `periodo_id`, `promedio`, `curso`, `estadonota`, `momento_nota`) VALUES
(1, 3, 1, 4, 3, 4, 1, 4, 1, 4, 1),
(2, 3, 2, 5, 4, 5, 1, 5, 1, 2, 1),
(3, 3, 3, 16, 12, 13, 1, 14, 1, 2, 1),
(4, 3, 4, 13, 18, 16, 1, 16, 1, 2, 1),
(5, 4, 1, 5, 5, 5, 1, 5, 1, 2, 1),
(6, 4, 2, 4, 15, 4, 1, 8, 1, 2, 1),
(7, 4, 3, 16, 6, 12, 1, 11, 1, 2, 1),
(9, 3, 5, 18, 17, 15, 1, 17, 1, 2, 1),
(11, 5, 1, 6, 12, 16, 1, 11, 1, 2, 1),
(12, 5, 2, 16, 17, 19, 1, 17, 1, 2, 1),
(13, 5, 3, 15, 16, 17, 1, 16, 1, 2, 1),
(14, 5, 4, 15, 15, 15, 1, 15, 1, 2, 1),
(15, 5, 5, 14, 14, 14, 1, 14, 1, 2, 1),
(16, 11, 1, 20, 12, 0, 1, 0, 1, 2, 1),
(17, 4, 6, 15, 16, 18, 1, 16, 1, 2, 1),
(18, 4, 7, 15, 17, 19, 1, 17, 1, 2, 1),
(19, 4, 8, 2, 14, 16, 1, 11, 1, 2, 1),
(20, 4, 9, 16, 17, 17, 1, 17, 1, 2, 1),
(21, 4, 25, 16, 18, 17, 1, 17, 1, 2, 1),
(22, 4, 26, 16, 18, 17, 1, 17, 1, 2, 1),
(23, 14, 1, 17, 16, 16, 1, 16, 1, 2, 1),
(24, 14, 2, 17, 18, 19, 1, 18, 1, 2, 1),
(25, 14, 3, 15, 18, 17, 1, 17, 1, 2, 1),
(26, 14, 7, 17, 16, 19, 1, 17, 1, 2, 1),
(27, 14, 6, 17, 19, 17, 1, 18, 1, 2, 1),
(28, 14, 8, 17, 5, 16, 1, 13, 1, 2, 1),
(29, 14, 9, 18, 18, 17, 1, 18, 1, 2, 1),
(30, 14, 25, 13, 8, 17, 1, 13, 1, 2, 1),
(31, 14, 26, 17, 16, 18, 1, 17, 1, 2, 1),
(32, 14, 10, 11, 17, 17, 2, 15, 2, 2, 1),
(33, 14, 11, 16, 18, 17, 2, 17, 2, 2, 1),
(34, 14, 12, 7, 13, 9, 2, 10, 2, 2, 1),
(35, 14, 13, 16, 15, 17, 2, 16, 2, 2, 1),
(36, 14, 14, 16, 14, 18, 2, 16, 2, 2, 1),
(37, 14, 15, 17, 15, 17, 2, 16, 2, 2, 1),
(38, 14, 16, 17, 18, 14, 2, 16, 2, 2, 1),
(39, 14, 45, 14, 13, 18, 2, 15, 2, 2, 1),
(40, 14, 46, 16, 17, 18, 2, 17, 2, 2, 1),
(41, 14, 28, 14, 13, 16, 4, 14, 4, 2, 1),
(42, 14, 29, 13, 15, 15, 4, 14, 4, 2, 1),
(43, 14, 30, 16, 15, 15, 4, 15, 4, 2, 1),
(44, 14, 31, 11, 18, 11, 4, 13, 4, 2, 1),
(45, 14, 32, 17, 17, 18, 4, 17, 4, 2, 1),
(46, 14, 33, 14, 16, 17, 4, 16, 4, 2, 1),
(47, 14, 35, 19, 17, 12, 4, 16, 4, 2, 1),
(48, 14, 36, 17, 18, 18, 4, 18, 4, 2, 1),
(49, 14, 37, 17, 19, 18, 4, 18, 4, 2, 1),
(50, 14, 48, 16, 18, 19, 4, 18, 4, 2, 1),
(51, 14, 51, 16, 18, 17, 4, 17, 4, 2, 1),
(52, 14, 17, 12, 12, 19, 5, 14, 3, 2, 1),
(53, 14, 18, 15, 14, 15, 5, 15, 3, 2, 1),
(54, 14, 19, 14, 14, 17, 5, 15, 3, 2, 1),
(55, 14, 20, 16, 18, 18, 5, 17, 3, 2, 1),
(56, 14, 21, 15, 18, 18, 5, 17, 3, 2, 1),
(57, 14, 22, 16, 18, 17, 5, 17, 3, 2, 1),
(58, 14, 23, 17, 18, 17, 5, 17, 3, 2, 1),
(59, 14, 27, 17, 17, 19, 5, 18, 3, 2, 1),
(60, 14, 47, 16, 18, 17, 5, 17, 3, 2, 1),
(61, 14, 50, 16, 20, 20, 5, 19, 3, 2, 1),
(62, 14, 38, 14, 18, 17, 6, 16, 5, 2, 1),
(63, 14, 39, 16, 17, 19, 6, 17, 5, 2, 1),
(64, 14, 40, 16, 11, 16, 6, 14, 5, 2, 1),
(65, 14, 41, 16, 18, 18, 6, 17, 5, 2, 1),
(66, 14, 42, 17, 18, 19, 6, 18, 5, 2, 1),
(67, 14, 43, 17, 9, 19, 6, 15, 5, 2, 1),
(68, 14, 44, 15, 13, 6, 6, 11, 5, 2, 1),
(69, 14, 49, 16, 13, 17, 6, 15, 5, 2, 1),
(70, 14, 52, 17, 18, 20, 6, 18, 5, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `periodo_id` int(11) NOT NULL,
  `nombre_periodo` varchar(11) NOT NULL DEFAULT '2020-2021',
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`periodo_id`, `nombre_periodo`, `estado`) VALUES
(1, '2016-2017', 1),
(2, '2017-2018', 2),
(3, '2021-2022', 2),
(4, '2019-2020', 2),
(5, '2018-2019', 2),
(6, '2020-2021', 2);

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
  `statuspr` int(11) NOT NULL DEFAULT 1,
  `grupo_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `primer_año`
--

INSERT INTO `primer_año` (`primero_id`, `alumno_id`, `aula_id`, `periodo_id`, `numero_lista`, `statuspr`, `grupo_id`) VALUES
(1, 3, 1, 1, 1, 2, 3),
(2, 4, 1, 1, 2, 1, 2),
(3, 5, 1, 1, 3, 1, 1),
(4, 6, 1, 1, 4, 1, 1),
(5, 7, 2, 1, 1, 1, 2),
(6, 11, 1, 1, 10, 1, 5),
(7, 14, 1, 1, 11, 1, 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`profesor_id`, `apellido`, `nombre`, `cedula`, `estadopr`) VALUES
(1, 'GUILLEN QUINTERO', 'NILBA OLIMPIA', '8025474', 1),
(2, 'UZCATEGUI PEÑA', 'ZORAIMA', '14151617', 1),
(3, 'INACTIVO', 'NO ACTIVO', '20202020', 2),
(4, 'RANGEL', 'SOL', '20849332', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_materias`
--

CREATE TABLE `profesor_materias` (
  `profesor_materia_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `evaluaciones` int(2) NOT NULL DEFAULT 4,
  `estado_profesor_materia` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor_materias`
--

INSERT INTO `profesor_materias` (`profesor_materia_id`, `profesor_id`, `materia_id`, `aula_id`, `evaluaciones`, `estado_profesor_materia`) VALUES
(1, 2, 1, 1, 3, 1),
(2, 2, 4, 1, 4, 2),
(3, 2, 1, 2, 4, 0),
(4, 2, 2, 2, 4, 1),
(5, 1, 4, 1, 4, 2),
(6, 2, 1, 2, 4, 1),
(7, 2, 2, 1, 4, 1),
(8, 4, 1, 2, 4, 1);

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
  `statusqn` int(11) NOT NULL DEFAULT 1,
  `grupo_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `quinto_año`
--

INSERT INTO `quinto_año` (`quinto_id`, `alumno_id`, `aula_id`, `periodo_id`, `numero_lista`, `statusqn`, `grupo_id`) VALUES
(1, 4, 1, 1, 1, 1, 4),
(2, 6, 1, 1, 2, 1, 3),
(3, 14, 1, 6, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `reporte_id` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Asistente'),
(3, 'Maxi Administrador');

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
  `statussg` int(11) NOT NULL DEFAULT 1,
  `grupo_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `segundo_año`
--

INSERT INTO `segundo_año` (`segundo_id`, `alumno_id`, `aula_id`, `periodo_id`, `numero_lista`, `statussg`, `grupo_id`) VALUES
(1, 5, 1, 1, 1, 1, 3),
(2, 3, 1, 1, 6, 3, 5),
(3, 14, 1, 2, 1, 1, 5);

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
  `statustr` int(11) NOT NULL DEFAULT 1,
  `grupo_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tercer_año`
--

INSERT INTO `tercer_año` (`tercer_id`, `alumno_id`, `aula_id`, `periodo_id`, `numero_lista`, `statustr`, `grupo_id`) VALUES
(1, 3, 1, 1, 1, 1, 4),
(2, 14, 1, 5, 1, 1, 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `usuario`, `clave`, `rol`, `estado`) VALUES
(1, 'Administrador', 'admin', '$2y$10$umiy/n/WfT4BITO455EQzeuQphiSqlRk2DSJHj9rfAxzRnXvPEuKq', 1, 1),
(15, 'PEPE', 'pepe', '$2y$10$YceSIbjJg9ZX8ehRyX/nCuuJCquCPZM4M8oF6imck0NCd1eNl10K6', 1, 1),
(16, 'JORGE', 'jorji22', '$2y$10$YlwAgxyXSHjU31.i/tCXGu/9sn1fhWopnZJ4YqzLzkMMqMci7Zeem', 1, 2),
(17, 'DIRECTOR', 'maxiAdmin', '$2y$10$c1zyE75EZ.yr6J.ftWjIZuuMWkBOo3eGGF6aDjw.jp3CeSsOMM80q', 3, 1),
(19, 'ANGELA', 'angela', '$2y$10$Yyseh07CBjrDrQKdtjqAwuYgCinigDyOUbsYCMpmA5aPuPiifjk9a', 2, 1);

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
  ADD KEY `periodo_id` (`periodo_id`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `datos_liceo`
--
ALTER TABLE `datos_liceo`
  ADD PRIMARY KEY (`id_liceo`);

--
-- Indices de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  ADD PRIMARY KEY (`id_estadisticas`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`grupo_id`);

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
  ADD KEY `periodo_id` (`periodo_id`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`profesor_id`);

--
-- Indices de la tabla `profesor_materias`
--
ALTER TABLE `profesor_materias`
  ADD PRIMARY KEY (`profesor_materia_id`),
  ADD KEY `profesor_id` (`profesor_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `aula_id` (`aula_id`);

--
-- Indices de la tabla `quinto_año`
--
ALTER TABLE `quinto_año`
  ADD PRIMARY KEY (`quinto_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `periodo_id` (`periodo_id`),
  ADD KEY `grupo_id` (`grupo_id`);

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
  ADD KEY `periodo_id` (`periodo_id`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `tercer_año`
--
ALTER TABLE `tercer_año`
  ADD PRIMARY KEY (`tercer_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `periodo_id` (`periodo_id`),
  ADD KEY `grupo_id` (`grupo_id`);

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
  MODIFY `alumno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `aula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cuarto_año`
--
ALTER TABLE `cuarto_año`
  MODIFY `cuarto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `datos_liceo`
--
ALTER TABLE `datos_liceo`
  MODIFY `id_liceo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  MODIFY `id_estadisticas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `grupo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `materia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `nota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `periodo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `primer_año`
--
ALTER TABLE `primer_año`
  MODIFY `primero_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `profesor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `profesor_materias`
--
ALTER TABLE `profesor_materias`
  MODIFY `profesor_materia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `quinto_año`
--
ALTER TABLE `quinto_año`
  MODIFY `quinto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `reporte_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `segundo_año`
--
ALTER TABLE `segundo_año`
  MODIFY `segundo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tercer_año`
--
ALTER TABLE `tercer_año`
  MODIFY `tercer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuarto_año`
--
ALTER TABLE `cuarto_año`
  ADD CONSTRAINT `cuarto_año_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuarto_año_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuarto_año_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuarto_año_ibfk_4` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `primer_año_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `primer_año_ibfk_4` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesor_materias`
--
ALTER TABLE `profesor_materias`
  ADD CONSTRAINT `profesor_materias_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`profesor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesor_materias_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesor_materias_ibfk_4` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `quinto_año`
--
ALTER TABLE `quinto_año`
  ADD CONSTRAINT `quinto_año_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quinto_año_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quinto_año_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quinto_año_ibfk_4` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `segundo_año`
--
ALTER TABLE `segundo_año`
  ADD CONSTRAINT `segundo_año_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `segundo_año_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `segundo_año_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `segundo_año_ibfk_4` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tercer_año`
--
ALTER TABLE `tercer_año`
  ADD CONSTRAINT `tercer_año_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tercer_año_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tercer_año_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tercer_año_ibfk_4` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
