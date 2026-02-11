<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Models\Bike;
use App\Repositories\BikeRepository;
use PDO;

final class BikeRepositoryTest extends TestCase
{
    private PDO $pdo;
    private BikeRepository $repo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec(
            'CREATE TABLE fietsen (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                merk TEXT NOT NULL,
                type TEXT NOT NULL,
                prijs INTEGER NOT NULL,
                foto TEXT NOT NULL
            )'
        );

        $this->repo = new BikeRepository($this->pdo);
    }

    public function testCreateAndGetById(): void
    {
        $id = $this->repo->create(new Bike(null, 'Batavus', 'Flying D', 749, 'Fiets3.jpg'));
        $bike = $this->repo->getById($id);

        $this->assertNotNull($bike);
        $this->assertSame($id, $bike->id);
        $this->assertSame('Batavus', $bike->merk);
    }

    public function testUpdate(): void
    {
        $id = $this->repo->create(new Bike(null, 'Gazelle', 'Old', 100, 'x.jpg'));
        $ok = $this->repo->update(new Bike($id, 'Gazelle', 'New', 200, 'y.jpg'));

        $this->assertTrue($ok);

        $bike = $this->repo->getById($id);
        $this->assertSame('New', $bike->type);
        $this->assertSame(200, $bike->prijs);
    }

    public function testDelete(): void
    {
        $id = $this->repo->create(new Bike(null, 'Test', 'ToDelete', 1, 'z.jpg'));
        $this->assertTrue($this->repo->delete($id));
        $this->assertNull($this->repo->getById($id));
    }

    public function testGetAllReturnsArray(): void
    {
        $this->repo->create(new Bike(null, 'A', 'T1', 10, 'a.jpg'));
        $this->repo->create(new Bike(null, 'B', 'T2', 20, 'b.jpg'));

        $all = $this->repo->getAll();

        $this->assertIsArray($all);
        $this->assertGreaterThanOrEqual(2, count($all));
        $this->assertArrayHasKey('merk', $all[0]);
    }
}
