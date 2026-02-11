<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Database\Database;
use PDO;

final class DatabaseTest extends TestCase
{
    public function testDatabaseReturnsPdoConnection(): void
    {
        // Use sqlite in memory for a safe test (no MySQL required)
        $db = new Database('sqlite::memory:', '', '');
        $pdo = $db->getConnection();

        $this->assertInstanceOf(PDO::class, $pdo);
    }
}
