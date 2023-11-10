CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'Procesadores'),
(2, 'Motherboards'),
(3, 'Placas de video');

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `id_categoria`) VALUES
(1, 'AMD Ryzen 5 7600', 230, 1),
(2, 'AMD Ryzen 7 7700', 315, 1),
(3, 'AMD Ryzen 9 7900', 420, 1),
(4, 'Intel Core i5-13500', 250, 1),
(5, 'Intel Core i7-13700', 370, 1),
(6, 'Intel Core i9-13900', 580, 1),
(7, 'MSI A620M-E', 75, 2),
(8, 'Gigabyte B650', 220, 2),
(9, 'Asus X670E-E', 470, 2),
(10, 'MSI H610M', 80, 2),
(11, 'ASRock B660M', 120, 2),
(12, 'Gigabyte Z790', 250, 2),
(13, 'Asus 4060', 300, 3),
(15, 'Zotac 4070', 550, 3),
(17, 'Gigabyte 4080', 1100, 3),
(19, 'XFX 7600', 250, 3),
(21, 'Sapphire 7700', 450, 3),
(23, 'ASRock 7800', 530, 3);

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`id`, `usuario`, `contraseña`) VALUES
(1, 'webadmin', '$2a$12$vcYDk0DzerX3HltbBoSY2OOgke2ygFNOtk0gCIT8vommp/V78KSRy');

ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `Categoria_id` (`id_categoria`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `productos`
  ADD CONSTRAINT `Categoria_id` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;