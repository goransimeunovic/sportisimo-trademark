CREATE TABLE `trademarks` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(45) DEFAULT NULL,
    `visibility` tinyint(1) DEFAULT '1',
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `sportisimo-dev`.trademarks (name)
VALUES
    ('Adidas'),
    ('Nike'),
    ('Assics'),
    ('Star'),
    ('Ellesse'),
    ('Head'),
    ('Wilson'),
    ('Babolat'),
    ('Yonex'),
    ('Sport'),
    ('Diadora'),
    ('Hummel'),
    ('Sergio Tacchini'),
    ('Russell Athletic'),
    ('Li Ning'),
    ('Fila'),
    ('Kappa'),
    ('Sergio'),
    ('Elan');