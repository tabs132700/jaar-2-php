<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

class User
{
    public function __construct(private Database $database)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function createUser(string $name, string $email, string $password): bool
    {
        if ($name === '' || $email === '' || $password === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
        $stmt = $this->database->getConnection()->prepare($sql);

        try {
            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hash,
            ]);
        } catch (PDOException) {
            return false;
        }
    }

    public function loginUser(string $email, string $password): bool
    {
        $sql = 'SELECT id, name, password FROM users WHERE email = :email LIMIT 1';
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $email,
        ];

        return true;
    }

    public function logoutUser(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly'] ?? true
            );
        }
        session_destroy();
    }
}
