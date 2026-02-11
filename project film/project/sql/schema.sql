-- Schema for Film Registratie Systeem
-- Creates database, tables and constraints

CREATE DATABASE IF NOT EXISTS `filmdb`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE `filmdb`;

CREATE TABLE IF NOT EXISTS `film` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(150) NOT NULL,
  `genre` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `acteur` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `film_acteur` (
  `film_id` INT UNSIGNED NOT NULL,
  `acteur_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`film_id`, `acteur_id`),
  KEY `idx_fa_acteur` (`acteur_id`),
  CONSTRAINT `fk_fa_film` FOREIGN KEY (`film_id`) REFERENCES `film`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_fa_acteur` FOREIGN KEY (`acteur_id`) REFERENCES `acteur`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

