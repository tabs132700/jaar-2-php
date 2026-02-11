<?php
require_once __DIR__ . '/../Database/Database.php';
require_once __DIR__ . '/Acteur.php';

class FilmActeur
{
    public static function link(int $filmId, int $acteurId): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO film_acteur (film_id, acteur_id) VALUES (:film_id, :acteur_id)');
        return $stmt->execute([
            ':film_id' => $filmId,
            ':acteur_id' => $acteurId,
        ]);
    }

    public static function getActeursByFilm(int $filmId): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('
            SELECT a.id, a.naam
            FROM acteur a
            INNER JOIN film_acteur fa ON fa.acteur_id = a.id
            WHERE fa.film_id = :film_id
            ORDER BY a.naam
        ');
        $stmt->execute([':film_id' => $filmId]);
        $rows = $stmt->fetchAll();
        $actors = [];
        foreach ($rows as $row) {
            $actors[] = new Acteur((int)$row['id'], $row['naam']);
        }
        return $actors;
    }
}

