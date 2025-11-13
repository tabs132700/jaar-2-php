-- Film Registratie Systeem - volledige database dump (schema + data)
-- Safe to run multiple times; drops tables in correct order.

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET FOREIGN_KEY_CHECKS=0;

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS `filmdb`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE `filmdb`;

-- Drop existing tables for a clean import (order matters)
DROP TABLE IF EXISTS `film_acteur`;
DROP TABLE IF EXISTS `acteur`;
DROP TABLE IF EXISTS `film`;

-- Tables
CREATE TABLE `film` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(150) NOT NULL,
  `genre` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_film_naam` (`naam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `acteur` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_acteur_naam` (`naam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `film_acteur` (
  `film_id` INT UNSIGNED NOT NULL,
  `acteur_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`film_id`, `acteur_id`),
  KEY `idx_fa_acteur` (`acteur_id`),
  CONSTRAINT `fk_fa_film` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_fa_acteur` FOREIGN KEY (`acteur_id`) REFERENCES `acteur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;

-- Sample data
INSERT INTO `film` (`naam`, `genre`) VALUES
  ('Inception', 'Sci-Fi'),
  ('The Godfather', 'Crime'),
  ('The Matrix', 'Sci-Fi'),
  ('Pulp Fiction', 'Crime');

INSERT INTO `acteur` (`naam`) VALUES
  ('Leonardo DiCaprio'),
  ('Marlon Brando'),
  ('Al Pacino'),
  ('Keanu Reeves'),
  ('John Travolta'),
  ('Samuel L. Jackson');

-- Link actors to films (composite PK prevents duplicates)
INSERT INTO `film_acteur` (`film_id`, `acteur_id`)
SELECT f.id, a.id
FROM (SELECT 'Inception' AS fname, 'Leonardo DiCaprio' AS aname UNION ALL
      SELECT 'The Godfather', 'Marlon Brando' UNION ALL
      SELECT 'The Godfather', 'Al Pacino' UNION ALL
      SELECT 'The Matrix', 'Keanu Reeves' UNION ALL
      SELECT 'Pulp Fiction', 'John Travolta' UNION ALL
      SELECT 'Pulp Fiction', 'Samuel L. Jackson') seed
JOIN film f ON f.naam = seed.fname
JOIN acteur a ON a.naam = seed.aname
ON DUPLICATE KEY UPDATE film_id = VALUES(film_id), acteur_id = VALUES(acteur_id);

