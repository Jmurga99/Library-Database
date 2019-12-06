-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-08-2019 a las 21:49:02
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `ID_a` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_cat` int(11) NOT NULL,
  `Categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `ID_e` int(11) NOT NULL,
  `Editorial` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lectores`
--

CREATE TABLE `lectores` (
  `ID_lec` int(11) NOT NULL,
  `Cedula` varchar(15) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `Correo` varchar(200) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `ID_lib` int(11) NOT NULL,
  `Titulo` varchar(200) DEFAULT NULL,
  `Publicacion` varchar(200) DEFAULT NULL,
  `ejemplares` int(11) DEFAULT NULL,
  `cota` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_lec_lib`
--

CREATE TABLE `rel_lec_lib` (
  `ID_lec` int(11) NOT NULL,
  `ID_lib` int(11) NOT NULL,
  `Dev` date DEFAULT NULL,
  `Tipo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_lec_tip`
--

CREATE TABLE `rel_lec_tip` (
  `ID_lec` int(11) NOT NULL,
  `ID_t` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_lib_aut`
--

CREATE TABLE `rel_lib_aut` (
  `ID_lib` int(11) NOT NULL,
  `ID_a` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_lib_cat`
--

CREATE TABLE `rel_lib_cat` (
  `ID_lib` int(11) NOT NULL,
  `ID_cat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_lib_edi`
--

CREATE TABLE `rel_lib_edi` (
  `ID_lib` int(11) NOT NULL,
  `ID_e` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_lector`
--

CREATE TABLE `tipo_lector` (
  `ID_t` int(11) NOT NULL,
  `Tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`ID_a`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_cat`);

--
-- Indices de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`ID_e`);

--
-- Indices de la tabla `lectores`
--
ALTER TABLE `lectores`
  ADD PRIMARY KEY (`ID_lec`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`ID_lib`);

--
-- Indices de la tabla `rel_lec_lib`
--
ALTER TABLE `rel_lec_lib`
  ADD PRIMARY KEY (`ID_lec`,`ID_lib`),
  ADD KEY `ID_lib` (`ID_lib`);

--
-- Indices de la tabla `rel_lec_tip`
--
ALTER TABLE `rel_lec_tip`
  ADD PRIMARY KEY (`ID_lec`),
  ADD KEY `ID_t` (`ID_t`);

--
-- Indices de la tabla `rel_lib_aut`
--
ALTER TABLE `rel_lib_aut`
  ADD PRIMARY KEY (`ID_lib`,`ID_a`),
  ADD KEY `ID_a` (`ID_a`);

--
-- Indices de la tabla `rel_lib_cat`
--
ALTER TABLE `rel_lib_cat`
  ADD PRIMARY KEY (`ID_lib`),
  ADD KEY `ID_cat` (`ID_cat`);

--
-- Indices de la tabla `rel_lib_edi`
--
ALTER TABLE `rel_lib_edi`
  ADD PRIMARY KEY (`ID_lib`),
  ADD KEY `ID_e` (`ID_e`);

--
-- Indices de la tabla `tipo_lector`
--
ALTER TABLE `tipo_lector`
  ADD PRIMARY KEY (`ID_t`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `ID_a` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_cat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  MODIFY `ID_e` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lectores`
--
ALTER TABLE `lectores`
  MODIFY `ID_lec` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `ID_lib` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_lector`
--
ALTER TABLE `tipo_lector`
  MODIFY `ID_t` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rel_lec_lib`
--
ALTER TABLE `rel_lec_lib`
  ADD CONSTRAINT `rel_lec_lib_ibfk_1` FOREIGN KEY (`ID_lec`) REFERENCES `lectores` (`ID_lec`),
  ADD CONSTRAINT `rel_lec_lib_ibfk_2` FOREIGN KEY (`ID_lib`) REFERENCES `libros` (`ID_lib`);

--
-- Filtros para la tabla `rel_lec_tip`
--
ALTER TABLE `rel_lec_tip`
  ADD CONSTRAINT `rel_lec_tip_ibfk_1` FOREIGN KEY (`ID_lec`) REFERENCES `lectores` (`ID_lec`),
  ADD CONSTRAINT `rel_lec_tip_ibfk_2` FOREIGN KEY (`ID_t`) REFERENCES `tipo_lector` (`ID_t`);

--
-- Filtros para la tabla `rel_lib_aut`
--
ALTER TABLE `rel_lib_aut`
  ADD CONSTRAINT `rel_lib_aut_ibfk_1` FOREIGN KEY (`ID_lib`) REFERENCES `libros` (`ID_lib`),
  ADD CONSTRAINT `rel_lib_aut_ibfk_2` FOREIGN KEY (`ID_a`) REFERENCES `autores` (`ID_a`);

--
-- Filtros para la tabla `rel_lib_cat`
--
ALTER TABLE `rel_lib_cat`
  ADD CONSTRAINT `rel_lib_cat_ibfk_1` FOREIGN KEY (`ID_lib`) REFERENCES `libros` (`ID_lib`),
  ADD CONSTRAINT `rel_lib_cat_ibfk_2` FOREIGN KEY (`ID_cat`) REFERENCES `categoria` (`ID_cat`);

--
-- Filtros para la tabla `rel_lib_edi`
--
ALTER TABLE `rel_lib_edi`
  ADD CONSTRAINT `rel_lib_edi_ibfk_1` FOREIGN KEY (`ID_lib`) REFERENCES `libros` (`ID_lib`),
  ADD CONSTRAINT `rel_lib_edi_ibfk_2` FOREIGN KEY (`ID_e`) REFERENCES `editoriales` (`ID_e`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
