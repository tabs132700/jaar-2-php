<?php
require_once __DIR__ . '/../Database/Database.php';

class Acteur
{
    public ?int $id;
    public string $naam;

    public function __construct(?int $id = null, string $naam = '')
    {
        $this->id = $id;
        $this->naam = $naam;
    }

    public function save(): bool
    {
        $pdo = Database::getConnection();
        if ($this->id) {
            $stmt = $pdo->prepare('UPDATE acteur SET naam = :naam WHERE id = :id');
            return $stmt->execute([
                ':naam' => $this->naam,
                ':id' => $this->id,
            ]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO acteur (naam) VALUES (:naam)');
            $ok = $stmt->execute([':naam' => $this->naam]);
            if ($ok) {
                $this->id = (int)$pdo->lastInsertId();
            }
            return $ok;
        }
    }

    public static function getAll(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT id, naam FROM acteur ORDER BY naam');
        $rows = $stmt->fetchAll();
        $actors = [];
        foreach ($rows as $row) {
            $actors[] = new Acteur((int)$row['id'], $row['naam']);
        }
        return $actors;
    }

    public static function getById(int $id): ?Acteur
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT id, naam FROM acteur WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        if ($row) {
            return new Acteur((int)$row['id'], $row['naam']);
        }
        return null;
    }
}

