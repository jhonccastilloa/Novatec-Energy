-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2022 a las 19:25:37
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `novatec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Termas Solares'),
(2, 'Paneles Solares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `subcategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subcategory`
--

INSERT INTO `subcategory` (`id`, `id_category`, `subcategory`) VALUES
(1, 1, 'General Termas Solares'),
(2, 2, 'General Paneles Solares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `filename` varchar(250) NOT NULL DEFAULT '',
  `filesize` int(11) NOT NULL DEFAULT 0,
  `web_path` varchar(250) NOT NULL DEFAULT '',
  `system_path` varchar(250) NOT NULL DEFAULT '',
  `test` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `filename`, `filesize`, `web_path`, `system_path`, `test`) VALUES
(1, 'English.png', 146569, '/Novatec-Energy/uploads/1.png', 'C:/xampp/htdocs/Novatec-Energy/uploads/1.png', 0),
(2, 'English.png', 146569, '/Novatec-Energy/uploads/2.png', 'C:/xampp/htdocs/Novatec-Energy/uploads/2.png', 0),
(3, 'English.png', 146569, '/Novatec-Energy/uploads/3.png', 'C:/xampp/htdocs/Novatec-Energy/uploads/3.png', 0),
(4, 'English.png', 146569, '/Novatec-Energy/uploads/4.png', 'C:/xampp/htdocs/Novatec-Energy/uploads/4.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `breve_descripcion` varchar(400) NOT NULL DEFAULT '',
  `precio_normal` decimal(10,2) NOT NULL,
  `precio_rebajado` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_subcategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `breve_descripcion`, `precio_normal`, `precio_rebajado`, `cantidad`, `imagen`, `id_categoria`, `id_subcategory`) VALUES
(11, 'Panel solar', '<p>es un buen panel solar</p>\r\n\r\n<ul>\r\n	<li>es duradero</li>\r\n	<li>fuert</li>\r\n	<li>masiso</li>\r\n</ul>\r\n', 'es un buen panel solar', '123.00', '12.00', 1, 's', 1, 1),
(16, 'Panel solar', '<p>es un buen panel solar</p>\r\n\r\n<ul>\r\n	<li>es duradero</li>\r\n	<li>fuert</li>\r\n	<li>masiso</li>\r\n</ul>\r\n', 'es un buen panel solar', '123.00', '12.00', 1, '1sda', 2, 2),
(17, 'Panel solar', '<p>es un buen panel solar</p>\r\n\r\n<ul>\r\n	<li>es duradero</li>\r\n	<li>fuert</li>\r\n	<li>masiso</li>\r\n</ul>\r\n', 'es un buen panel solar', '123.00', '12.00', 1, NULL, 2, 2),
(18, 'Panel solar', '<p>es un buen panel solar</p>\r\n\r\n<ul>\r\n	<li>es duradero</li>\r\n	<li>fuert</li>\r\n	<li>masiso</li>\r\n</ul>\r\n', 'es un buen panel solar', '123.00', '12.00', 1, NULL, 2, 2),
(19, 'Panel solar', '<p>es un buen panel solar</p>\r\n\r\n<ul>\r\n	<li>es duradero</li>\r\n	<li>fuert</li>\r\n	<li>masiso</li>\r\n</ul>\r\n', 'es un buen panel solar', '123.00', '12.00', 1, '1asd', 2, 2),
(21, 'Panel solar', '<p>es un buen panel solar</p>\r\n\r\n<ul>\r\n	<li>es duradero</li>\r\n	<li>fuert</li>\r\n	<li>masiso</li>\r\n</ul>\r\n', 'es un buen panel solar', '123.00', '12.00', 1, NULL, 2, 2),
(22, 'Panel solar', '<p>es un buen panel solar</p>\r\n\r\n<ul>\r\n	<li>es duradero</li>\r\n	<li>fuert</li>\r\n	<li>masiso</li>\r\n</ul>\r\n', 'es un buen panel solar', '123.00', '12.00', 1, NULL, 2, 2),
(23, 'Panel solar', '<p>es un buen panel solar</p>\r\n\r\n<ul>\r\n	<li>es duradero</li>\r\n	<li>fuert</li>\r\n	<li>masiso</li>\r\n</ul>\r\n', 'es un buen panel solar', '123.00', '12.00', 1, NULL, 2, 2),
(24, 'Panel solar', '<p>es un buen panel solar</p>\r\n\r\n<ul>\r\n	<li>es duradero</li>\r\n	<li>fuert</li>\r\n	<li>masiso</li>\r\n</ul>\r\n', 'es un buen panel solar', '123.00', '12.00', 1, NULL, 2, 2),
(25, 'Panel solar', '<p>es un buen panel solar</p>\r\n\r\n<ul>\r\n	<li>es duradero</li>\r\n	<li>fuert</li>\r\n	<li>masiso</li>\r\n</ul>\r\n', 'es un buen panel solar', '123.00', '12.00', 1, NULL, 1, 1),
(26, 'Panel solar', '\r\nes un buen panel solar\r\n\r\n\r\n\r\n\r\n\r\n\r\nes duradero\r\n\r\n\r\nfuert\r\n\r\n\r\nmasiso\r\n\r\n\r\n\r\n', 'es un buen panel solar', '123.00', '12.00', 12, NULL, 2, 2),
(27, 'Seiya', '<p>sadsadsad</p>\r\n', 'sadsadsad', '21.00', '1.00', 2, NULL, 2, 2),
(28, 'Seiya', '<p>sadsadsa</p>\r\n', 'sadsadsa', '213.00', '1.00', 1, NULL, 2, 2),
(31, 'Panel solar', '<p>El funcionamiento que nos ofrece el Panel Solar EcoGreen 200W 12V es de primera l&iacute;nea gracias a sus particularidades el&eacute;ctricas. Como ejemplo acreditamos que&nbsp;<strong>la eficacia del panel solar llega a un 15,27%</strong>&nbsp;y posee la informaci&oacute;n de productividad que indicamos a continuaci&oacute;n:</p>\r\n\r\n<p>- 200W de potencia pico (PMAX)</p>\r\n\r\n<p>- 19,14 (VMP) Voltaje a m&aacute;xima potencia</p>\r\n\r\n<p>-10,45A (IMP) Intensidad a m&aacute;xima potencia</p>\r\n\r\n<p>- 23,31V (VOC) Voltaje en circuito abierto</p>\r\n\r\n<p>- 11,41A (ISC) Intensidad en cortocircuito</p>\r\n\r\n<p>Esta informaci&oacute;n acerca de la productividad atiende a par&aacute;metros estandarizados tales como una radiaci&oacute;n de 1000W/m2, una masa de aire de 1,5 AM y con una temperatura de la c&eacute;lula de unos 25&ordm;. Puede ascender&nbsp;<strong>la tolerancia de potencia de salida del panel a +- 5W.</strong></p>\r\n\r\n<p>El Panel Solar 200W 12V Policristalino EcoGreen es sometido a ex&aacute;menes rigurosos para que sea posible conseguir una gran durabilidad, al igual que una sobresaliente calidad durante todo su periodo &uacute;til.&nbsp;<strong>Est&aacute; garantizado mec&aacute;nicamente durante 12 a&ntilde;os ante cualquier defecto en su fabricaci&oacute;n y de 25 a&ntilde;os si tiene como m&iacute;nimo un 80% de su potencia nominal y el m&oacute;dulo se encuentra totalmente nuevo</strong>.</p>\r\n\r\n<p>Cada uno de los Paneles Solares 200W 12V Policristalino EcoGreen&nbsp;<strong>est&aacute; compuesto por 72 unidades de c&eacute;lulas policristalinas</strong>. El panel solar&nbsp;<strong>pesa 15 kg</strong>&nbsp;y mide 1320x992x35mm. El marco del Panel Solar 200W 12V Policristalino EcoGreen est&aacute; realizado en&nbsp;<strong>aluminio anodizado de alta resistencia</strong>&nbsp;y se fija a la estructura en la cual sujetaremos el m&oacute;dulo fotovoltaico, garantizando &iacute;ntegramente su seguridad y evitar&aacute; que pueda producirse su movimiento.</p>\r\n', 'Panel solar EcoGreen 200W 12V policristalino', '120.00', '12.00', 1, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products_files`
--

CREATE TABLE `products_files` (
  `products_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products_files`
--

INSERT INTO `products_files` (`products_id`, `file_id`) VALUES
(11, 1),
(16, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `user_name`) VALUES
(1, 'castillo', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Jhon Carlos ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategory_category_pair` (`id`,`id_category`),
  ADD KEY `id_category` (`id_category`);

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_subcategory` (`id_subcategory`),
  ADD KEY `productos_subcategory_category` (`id_subcategory`,`id_categoria`);

--
-- Indices de la tabla `products_files`
--
ALTER TABLE `products_files`
  ADD PRIMARY KEY (`products_id`,`file_id`),
  ADD KEY `file_id` (`file_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_category_fk` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_subcategory_category_fk` FOREIGN KEY (`id_subcategory`,`id_categoria`) REFERENCES `subcategory` (`id`,`id_category`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `products_files`
--
ALTER TABLE `products_files`
  ADD CONSTRAINT `products_files_file_fk` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_files_product_fk` FOREIGN KEY (`products_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
