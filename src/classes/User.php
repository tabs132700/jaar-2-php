<?php
declare(strict_types=1);

// Functie: classdefinitie User
// Auteur: Studentnaam

class User
{
    private ?int $id = null;
    private PDO $db;
    public string $username = "";
    public string $email = "";
    private string $password = "";

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function showUser(): void
    {
        echo "<br>Username: $this->username<br>";
        echo "<br>Password: $this->password<br>";
        echo "<br>Email: $this->email<br>";
    }

    public function registerUser(string $username, string $password, string $email): bool
    {
        $username = trim($username);
        $email = trim($email);

        $this->validateUsername($username);
        $this->validatePassword($password);
        $this->validateEmail($email);

        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
            $stmt->execute([':username' => $username]);
            if ($stmt->fetchColumn() !== false) {
                $this->db->rollBack();
                throw new RuntimeException('Username is already taken.');
            }

            $stmt = $this->db->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
            $stmt->execute([':email' => $email]);
            if ($stmt->fetchColumn() !== false) {
                $this->db->rollBack();
                throw new RuntimeException('Email is already registered.');
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            if ($passwordHash === false) {
                $this->db->rollBack();
                throw new RuntimeException('Failed to hash password.');
            }

            $insert = $this->db->prepare(
                'INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)'
            );
            $insert->execute([
                ':username' => $username,
                ':email' => $email,
                ':password_hash' => $passwordHash,
            ]);

            $this->db->commit();

            $this->id = (int) $this->db->lastInsertId();
            $this->username = $username;
            $this->email = $email;

            return true;
        } catch (PDOException $exception) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw new RuntimeException('Failed to register user.');
        }
    }

    public function validateUser(): array
    {
        $errors = [];

        if (empty($this->username)) {
            $errors[] = "Invalid username";
        }
        if (empty($this->password)) {
            $errors[] = "Invalid password";
        }

        return $errors;
    }

    public function validateLogin(string $username): bool
    {
        $username = trim($username);
        $length = mb_strlen($username, 'UTF-8');
        $stmt = $this->db->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
        $stmt->execute([':username' => $username]);

        if ($length < 3 || $length > 50) {
            return false;
        }
        if ($stmt->fetchColumn() !== false) {
            return false;
        }

        return true;
    }

    public function loginUser(): bool
    {
        $username = trim($this->username);
        $password = $this->password;

        if ($username === '' || $password === '') {
            return false;
        }

        try {
            $statement = $this->db->prepare('SELECT * FROM users WHERE username = :username');
            $statement->execute([':username' => $username]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user && isset($user['password_hash']) && password_verify($password, $user['password_hash'])) {
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'] ?? $username;
                return true;
            }
        } catch (PDOException $exception) {
            error_log('Login failed: ' . $exception->getMessage());
        }

        return false;
    }

    public function logout(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_regenerate_id(true);

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                [
                    'expires' => time() - 42000,
                    'path' => $params['path'],
                    'domain' => $params['domain'],
                    'secure' => $params['secure'],
                    'httponly' => $params['httponly'],
                    'samesite' => $params['samesite'] ?? 'Lax',
                ]
            );
        }
        session_destroy();
    }

    public function isLoggedin(): bool
    {
        return isset($_SESSION) && !empty($_SESSION['username']);
    }

    public function getUser(string $username): bool
    {
        $stmt = $this->db->prepare('SELECT username, email FROM users WHERE username = :username LIMIT 1');
        $stmt->execute([':username' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return false;
        }

        $this->username = $row['username'] ?? '';
        $this->email = $row['email'] ?? '';
        return true;
    }

    private function validateUsername(string $username): void
    {
        $length = mb_strlen($username, 'UTF-8');
        if ($length < 3 || $length > 50) {
            throw new RuntimeException('Username must be between 3 and 50 characters.');
        }
        if (!preg_match('/^[A-Za-z0-9_]+$/', $username)) {
            throw new RuntimeException('Username may only contain letters, numbers, and underscores.');
        }
    }

    private function validatePassword(string $password): void
    {
        if (mb_strlen($password, '8bit') < 8) {
            throw new RuntimeException('Password must be at least 8 characters long.');
        }
        if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
            throw new RuntimeException('Password must contain at least one letter and one digit.');
        }
    }

    private function validateEmail(string $email): void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new RuntimeException('Invalid email address.');
        }
    }
}

// $user = new User($pdo);
// $user->registerUser('tariq', 'P@ssw0rd123', 'tariq@example.com');
// $user->logout();
