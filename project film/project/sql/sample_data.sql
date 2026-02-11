-- Optional sample data for quick testing
USE `filmdb`;

INSERT INTO `film` (`naam`, `genre`) VALUES
  ('Inception', 'Sci-Fi'),
  ('The Godfather', 'Crime');

INSERT INTO `acteur` (`naam`) VALUES
  ('Leonardo DiCaprio'),
  ('Marlon Brando'),
  ('Al Pacino');

-- Link a few actors to films
INSERT INTO `film_acteur` (`film_id`, `acteur_id`) VALUES
  ((SELECT id FROM film WHERE naam = 'Inception' LIMIT 1), (SELECT id FROM acteur WHERE naam = 'Leonardo DiCaprio' LIMIT 1)),
  ((SELECT id FROM film WHERE naam = 'The Godfather' LIMIT 1), (SELECT id FROM acteur WHERE naam = 'Marlon Brando' LIMIT 1)),
  ((SELECT id FROM film WHERE naam = 'The Godfather' LIMIT 1), (SELECT id FROM acteur WHERE naam = 'Al Pacino' LIMIT 1));

