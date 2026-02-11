<?php
declare(strict_types=1);

namespace App\Database;

use PDO;

final class Database
{
    private string $dsn;
    private string $user;
    private string $password;

    public function __construct(?string $dsn = null, ?string $user = null, ?string $password = null)
    {
        // Defaults for XAMPP local MySQL
        $this->dsn = $dsn ?? (getenv('DB_DSN') ?: 'mysql:host=localhost;dbname=fietsenmaker;charset=utf8mb4');
        $this->user = $user ?? (getenv('DB_USER') ?: 'root');
        $this->password = $password ?? (getenv('DB_PASS') ?: '');
    }

    public function getConnection(): PDO
    {
        $pdo = new PDO($this->dsn, $this->user, $this->password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        return $pdo;
    }
}
