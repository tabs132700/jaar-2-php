<?php

declare(strict_types=1);

use PDO;
use PDOException;
use RuntimeException;

    // Functie: classdefinitie User
    // Auteur: Studentnaam
class User
{
    private PDO $db;

    class User{
    private ?int $id = null;

        // Eigenschappen 
        public string $username = "";
        public string $email = "";
        private string $password = "";
        
        function setPassword($password){
            $this->password = $password;
        }
        function getPassword(){
            return $this->password;
        }
    private string $username = '';

        public function showUser() {
            echo "<br>Username: $this->username<br>";
            echo "<br>Password: $this->password<br>";
            echo "<br>Email: $this->email<br>";
            
        }
    private string $email = '';

        public function registerUser() : array {
            $status = false;
            $errors=[];
            if($this->username != ""){

                // Check user exist in database
                
                if(true){
                    array_push($errors, "Username bestaat al.");
                } else {
                    // username opslaan in tabel login
                    // INSERT INTO `user` (`username`, `password`, `role`) VALUES ('kjhasdasdkjhsak', 'asdasdasdasdas', '');
                    // Manier 1
                    
                    $status = true;
                } 
            }
            return $errors;
        }
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

        function validateUser(){
            $errors=[];
    public function registerUser(string $username, string $password, string $email): bool
    {
        $username = trim($username);
        $email = trim($email);

            if (empty($this->username)){
                array_push($errors, "Invalid username");
            } else if (empty($this->password)){
                array_push($errors, "Invalid password");
            }
        $this->validateUsername($username);
        $this->validatePassword($password);
        $this->validateEmail($email);

            // Test username > 3 tekens
            
            return $errors;
        }
        try {
            $this->db->beginTransaction();

        public function validateLogin(string $username): bool
        {
            $username = trim($username);
            $length = mb_strlen($username, 'UTF-8');
            $stmt = $this->db->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
            $stmt->execute([':username' => $username]);

            if ($length < 3 || $length > 50) {
                return false;
            if ($stmt->fetchColumn() !== false) {
                $this->db->rollBack();
                throw new RuntimeException('Username is already taken.');
            }

            return true;
        }

        public function loginUser(): bool {
            $username = trim($this->username);
            $password = $this->password;
            $stmt = $this->db->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
            $stmt->execute([':email' => $email]);

            if ($username === '' || $password === '') {
                return false;
            if ($stmt->fetchColumn() !== false) {
                $this->db->rollBack();
                throw new RuntimeException('Email is already registered.');
            }

            $pdo = $this->dbConnect();
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            if ($pdo === null) {
                return false;
            if ($passwordHash === false) {
                $this->db->rollBack();
                throw new RuntimeException('Failed to hash password.');
            }

            try {
                $statement = $pdo->prepare('SELECT * FROM User WHERE username = :username');
                $statement->execute(['username' => $username]);
                $user = $statement->fetch();
            $insert = $this->db->prepare(
                'INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)'
            );

                if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
                    if (session_status() !== PHP_SESSION_ACTIVE) {
                        session_start();
                    }
            $insert->execute([
                ':username' => $username,
                ':email' => $email,
                ':password_hash' => $passwordHash,
            ]);

                    if (isset($user['id'])) {
                        $_SESSION['user_id'] = $user['id'];
                    }
            $this->db->commit();
        } catch (PDOException $exception) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

                    $_SESSION['username'] = $user['username'] ?? $username;
            throw new RuntimeException('Failed to register user.');
        }

                    return true;
                }
            } catch (PDOException $exception) {
                error_log('Login failed: ' . $exception->getMessage());
            }
        $this->id = (int) $this->db->lastInsertId();
        $this->username = $username;
        $this->email = $email;

        return true;
    }

            return false;
    public function logout(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        // Check if the user is already logged in
        public function isLoggedin(): bool {
            // Check if user session has been set
            
            return false;
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

        public function getUser(string $username): bool {
            // Connect database
        session_destroy();
    }

		    // Doe SELECT * from user WHERE username = $username
    private function validateUsername(string $username): void
    {
        $length = mb_strlen($username, 'UTF-8');

            if (false){
                //Indien gevonden eigenschappen vullen met waarden uit de SELECT
                $this->username = 'Waarde uit de database';
                return true;
            } else {
                return false;
            }   
        if ($length < 3 || $length > 50) {
            throw new RuntimeException('Username must be between 3 and 50 characters.');
        }

        public function logout(){
            session_start();
            // remove all session variables
           

            // destroy the session
            
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

?>
// $user = new User($pdo);
// $user->registerUser('tariq', 'P@ssw0rd123', 'tariq@example.com');
// $user->logout();
