<?php
    class Model {
        protected $db;

        function __construct() {
          $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
            $this->deploy();
        }

        function deploy() {
            // Chequear si hay tablas
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            if(count($tables)==0) {
                // Si no hay crearlas
                $sql =<<<END
                --
                -- Table structure for table `categorias`
                --

                CREATE TABLE `categorias` (
                  `id_categoria` int(11) NOT NULL,
                  `nombre` varchar(45) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Dumping data for table `categorias`
                --

                INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
                (1, 'Procesadores'),
                (2, 'Motherboards'),
                (3, 'Placas de video');

                -- --------------------------------------------------------

                --
                -- Table structure for table `productos`
                --

                CREATE TABLE `productos` (
                  `id_producto` int(11) NOT NULL,
                  `nombre` varchar(50) NOT NULL,
                  `precio` int(11) NOT NULL,
                  `id_categoria` int(11) NOT NULL,
                  `oferta` tinyint(1) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Dumping data for table `productos`
                --

                INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `id_categoria`, `oferta`) VALUES
                (1, 'AMD Ryzen 5 7600', 230, 1, 0),
                (2, 'AMD Ryzen 7 7700', 315, 1, 0),
                (3, 'AMD Ryzen 9 7900', 420, 1, 1),
                (4, 'Intel Core i5-13500', 250, 1, 0),
                (5, 'Intel Core i7-13700', 370, 1, 1),
                (6, 'Intel Core i9-13900', 580, 1, 0),
                (7, 'MSI A620M-E', 75, 2, 0),
                (8, 'Gigabyte B650', 220, 2, 1),
                (9, 'Asus X670E-E', 470, 2, 0),
                (10, 'MSI H610M', 80, 2, 0),
                (11, 'ASRock B660M', 120, 2, 1),
                (12, 'Gigabyte Z790', 250, 2, 0),
                (13, 'Asus 4060', 300, 3, 1),
                (14, 'Zotac 4070', 550, 3, 0),
                (15, 'Gigabyte 4080', 1100, 3, 0),
                (16, 'XFX 7600', 250, 3, 0),
                (17, 'Sapphire 7700', 450, 3, 1),
                (18, 'ASRock 7800', 530, 3, 0);

                -- --------------------------------------------------------

                --
                -- Table structure for table `usuarios`
                --

                CREATE TABLE `usuarios` (
                  `id` int(11) NOT NULL,
                  `usuario` varchar(255) NOT NULL,
                  `contraseña` varchar(255) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Dumping data for table `usuarios`
                --

                INSERT INTO `usuarios` (`id`, `usuario`, `contraseña`) VALUES
                (1, 'webadmin', '$2a$12\$vcYDk0DzerX3HltbBoSY2OOgke2ygFNOtk0gCIT8vommp/V78KSRy');

                --
                -- Indexes for dumped tables
                --

                --
                -- Indexes for table `categorias`
                --
                ALTER TABLE `categorias`
                  ADD PRIMARY KEY (`id_categoria`);

                --
                -- Indexes for table `productos`
                --
                ALTER TABLE `productos`
                  ADD PRIMARY KEY (`id_producto`),
                  ADD KEY `Categoria_id` (`id_categoria`);

                --
                -- Indexes for table `usuarios`
                --
                ALTER TABLE `usuarios`
                  ADD PRIMARY KEY (`id`);

                --
                -- AUTO_INCREMENT for dumped tables
                --

                --
                -- AUTO_INCREMENT for table `productos`
                --
                ALTER TABLE `productos`
                  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

                --
                -- AUTO_INCREMENT for table `usuarios`
                --
                ALTER TABLE `usuarios`
                  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

                --
                -- Constraints for dumped tables
                --

                --
                -- Constraints for table `productos`
                --
                ALTER TABLE `productos`
                  ADD CONSTRAINT `Categoria_id` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
                COMMIT;
                END;
                $this->db->query($sql);
            }
        }
    }