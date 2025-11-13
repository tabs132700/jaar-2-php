<?php
require_once __DIR__ . '/../Database/Database.php';

class Film
{
    public ?int $id;
    public string $naam;
    public string $genre;

    public function __construct(?int $id = null, string $naam = '', string $genre = '')
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->genre = $genre;
    }

    public function save(): bool
    {
        $pdo = Database::getConnection();
        if ($this->id) {
            $stmt = $pdo->prepare('UPDATE film SET naam = :naam, genre = :genre WHERE id = :id');
            return $stmt->execute([
                ':naam' => $this->naam,
                ':genre' => $this->genre,
                ':id' => $this->id,
            ]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO film (naam, genre) VALUES (:naam, :genre)');
            $ok = $stmt->execute([
                ':naam' => $this->naam,
                ':genre' => $this->genre,
            ]);
            if ($ok) {
                $this->id = (int)$pdo->lastInsertId();
            }
            return $ok;
        }
    }

    public static function getAll(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT id, naam, genre FROM film ORDER BY id DESC');
        $rows = $stmt->fetchAll();
        $films = [];
        foreach ($rows as $row) {
            $films[] = new Film((int)$row['id'], $row['naam'], $row['genre']);
        }
        return $films;
    }

    public static function getById(int $id): ?Film
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT id, naam, genre FROM film WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        if ($row) {
            return new Film((int)$row['id'], $row['naam'], $row['genre']);
        }
        return null;
    }
}

