-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2021 a las 00:19:52
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `place` varchar(200) NOT NULL,
  `descrp` varchar(400) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `place`, `descrp`, `date_added`) VALUES
(1, 'Smartphones', '', '', '2017-04-02'),
(2, 'Tablets', '', '', '2017-04-02'),
(3, 'Monitores', '', '', '2017-04-02'),
(4, 'Camaras Digitales', '', '', '2017-04-02'),
(5, 'Almacenamiento', '', '', '2017-04-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `obs` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `direccion`, `telefono`, `obs`, `fechacreacion`) VALUES
(1, 'OCACIONAL', '.', '.', '.', '2021-02-15 13:56:54'),
(2, 'CONSUMIDOR FINAL', '.', '.', '.', '2021-02-15 13:56:54'),
(5, 'NOELIA BERNARDO', 'UNDEFINED', 'undefined', '', '2021-02-15 23:48:07'),
(6, 'NOELIA BERNARDO', 'UNDEFINED', 'undefined', '', '2021-02-15 23:48:17'),
(12, 'PEDRO DE MENDOZA', 'UNDEFINED', 'undefined', 'UNDEFINED', '2021-02-16 12:16:21'),
(13, 'JOSE MERCADO2', 'INGIS 131', '(301) 321-3___', '065464', '2021-02-16 12:18:38'),
(14, 'PEDRO BENICADSFS', 'MARCOS SASTRE 4626', '(301) 313-2110', '406546', '2021-02-16 12:19:36'),
(15, 'JOSE FABIANI2', 'MARCOS PAZ', '(033) 013-1031', '013012', '2021-02-17 11:56:49'),
(16, 'JOSE FABIANITERWT', '04646DFS', '(046) 464-6___', '06046', '2021-02-17 16:18:56'),
(17, 'PEDRO GARCIA2', 'SIMON BOLIVAR Y MONTANATO', '(405) 665-6565', '0465', '2021-02-17 13:02:47'),
(21, 'JUAN CARLOS', '3013', '(370) 440-6466', '04646', '2021-02-16 20:50:34'),
(22, 'PEDRO GARCIA2', 'JUAN AMANCIO 123', '(308) 979-0790', '06', '2021-02-17 12:40:49'),
(23, 'GERSON GOMEZ', 'PRINGRLES', '(307) 879-7906', '.', '2021-02-17 13:08:56'),
(28, 'BERNARDUSS', 'GABRIEL3708765', '(370) 654-75__', '.', '2021-02-18 23:08:55'),
(29, 'MISAEL BAEZ', '.', '(370) 406-0466', '.', '2021-02-24 17:33:55'),
(30, 'AGUSTIN INFORMATICA', 'URIBURU', '(370) 460-4646', '.', '2021-02-25 18:56:51'),
(31, 'WALTER ZABALA', 'LAGUNA BLANCA', '(370) 4__-____', '.', '2021-02-28 11:56:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `valor` text NOT NULL,
  `detalle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id`, `nombre`, `valor`, `detalle`) VALUES
(2, 'JSON', 'SI', '(SI/NO)'),
(3, 'RUTA', 'D:\\backupsPrograma', ''),
(4, 'bd', 'argelectric', ''),
(6, 'FACTURA ELECTRONICA', 'TICKET', '(TICKET/FACTURA)'),
(7, 'MODO', 'MODO_PRODUCCION', '2 MODOS'),
(8, 'CARACTERES_ESPECIALES', '.;()&', '%&()=).,;:#?¿?$!|@  -->se pueden agregar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `obs` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `obs`, `fechacreacion`) VALUES
(1, 'OTRO', '.', '2021-02-15 13:57:42'),
(2, 'NOTEBOOK', '.', '2021-02-24 22:40:39'),
(37, 'PC', NULL, '2021-02-24 23:29:46'),
(38, 'CELULAR', NULL, '2021-02-24 23:29:59'),
(39, 'MONITOR', NULL, '2021-02-24 23:30:07'),
(40, 'IMPRESORA', NULL, '2021-02-24 23:30:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `cliente` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `producto` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `producto_info` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `problema` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `presupuesto` double DEFAULT 0,
  `precio` double DEFAULT 0,
  `reparacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_usuario_creacion` int(11) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `fecha`, `cliente`, `telefono`, `producto`, `producto_info`, `problema`, `id_usuario`, `presupuesto`, `precio`, `reparacion`, `estado`, `id_usuario_creacion`, `fechacreacion`) VALUES
(1, '2021-02-25 15:21:53', 'JOSE FABIANI2', '(033) 013-1031', 'CELULAR', 'PANTALLA ROTA', 'REVISAR TAMBIEN EL MODULO', 62, 1500, 2000, 'cambie el modulo, tenia mal el flex', 1, 62, '2021-02-25 18:21:53'),
(5, '2021-02-25 15:46:28', 'BERNARDUSS', '(370) 654-75__', 'CELULAR', 'PIN DE CARGA', 'TRAJO EL CARGADOR', 62, 1000, 31221, '432423', 4, 62, '2021-02-25 18:46:28'),
(9, '2021-02-25 15:57:44', 'AGUSTIN INFORMATICA', '(370) 460-4646', 'IMPRESORA', 'LASER 1025 NO IMPRIME EN NEGRO', 'SIN CABLES', 62, 1600, 800, 'le falta el pcr, le llame para saber como se prosigue.\nMe trajo el pcr', 4, 62, '2021-02-25 18:57:44'),
(10, '2021-02-25 15:59:01', 'AGUSTIN INFORMATICA', '(370) 460-4646', 'IMPRESORA', 'IMPRESORA 1606 HP NO SABE EL PROBLEMA', 'EN CAJA Y CON CARTUCHO AFUERA', 62, 3500, 0, 'se reviso, pero no se hizo', 4, 62, '2021-02-25 18:59:01'),
(11, '2021-02-26 19:37:27', 'CONSUMIDOR FINAL', '(370) 646-0460', 'MONITOR', 'NO DA IMAGEN', 'TRAJO CABLES', 62, 1600, 1500, 'revisando', 4, 62, '2021-02-26 22:37:27'),
(12, '2021-02-28 08:56:44', 'WALTER ZABALA', '(370) 4__-____', 'PC', 'ES UNA HP', 'NO ANDA', 0, 0, 0, NULL, 1, 62, '2021-02-28 11:56:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'Administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'vistas/img/usuarios/admin/191.jpg', 1, '2021-02-15 08:24:58', '2021-02-15 13:24:58'),
(62, 'carlos ', 'charly', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Tecnico', 'vistas/img/usuarios/charly/274.jpg', 1, '2021-02-28 06:50:56', '2021-02-28 11:50:56');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
