<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Bike;
use PDO;

final class BikeRepository
{
    public function __construct(private PDO $pdo) {}

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getAll(): array
    {
        $stmt = $this->pdo->query('SELECT id, merk, type, prijs, foto FROM fietsen ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?Bike
    {
        $stmt = $this->pdo->prepare('SELECT id, merk, type, prijs, foto FROM fietsen WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Bike(
            (int)$row['id'],
            (string)$row['merk'],
            (string)$row['type'],
            (int)$row['prijs'],
            (string)$row['foto']
        );
    }

    public function create(Bike $bike): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO fietsen (merk, type, prijs, foto) VALUES (:merk, :type, :prijs, :foto)'
        );
        $stmt->execute([
            'merk' => $bike->merk,
            'type' => $bike->type,
            'prijs' => $bike->prijs,
            'foto' => $bike->foto,
        ]);

        return (int)$this->pdo->lastInsertId();
    }

    public function update(Bike $bike): bool
    {
        if ($bike->id === null) {
            return false;
        }

        $stmt = $this->pdo->prepare(
            'UPDATE fietsen SET merk = :merk, type = :type, prijs = :prijs, foto = :foto WHERE id = :id'
        );

        return $stmt->execute([
            'id' => $bike->id,
            'merk' => $bike->merk,
            'type' => $bike->type,
            'prijs' => $bike->prijs,
            'foto' => $bike->foto,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM fietsen WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
