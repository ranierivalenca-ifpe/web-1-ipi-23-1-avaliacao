DROP DATABASE IF EXISTS `web_1_ipi_23_1_api`;
CREATE DATABASE `web_1_ipi_23_1_api`;

USE `web_1_ipi_23_1_api`;

CREATE TABLE `categories` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `lost_items` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `description` text NOT NULL,
    `owner` varchar(255) NOT NULL,
    `contact` varchar(255) NOT NULL,
    `status` varchar(255) NOT NULL,
    `category_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
);