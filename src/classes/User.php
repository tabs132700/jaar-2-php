<?php

use PDO;
use PDOException;

    // Functie: classdefinitie User
    // Auteur: Studentnaam

    class User{

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

        public function showUser() {
            echo "<br>Username: $this->username<br>";
            echo "<br>Password: $this->password<br>";
            echo "<br>Email: $this->email<br>";
            
        }

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

        function validateUser(){
            $errors=[];

            if (empty($this->username)){
                array_push($errors, "Invalid username");
            } else if (empty($this->password)){
                array_push($errors, "Invalid password");
            }

            // Test username > 3 tekens
            
            return $errors;
        }

        public function validateLogin(string $username): bool
        {
            $username = trim($username);
            $length = mb_strlen($username, 'UTF-8');

            if ($length < 3 || $length > 50) {
                return false;
            }

            return true;
        }

        protected function dbConnect(): ?PDO
        {
            $dsn = 'mysql:host=localhost;dbname=Login;charset=utf8mb4';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try {
                return new PDO($dsn, 'root', '', $options);
            } catch (PDOException $exception) {
                error_log('Database connection failed: ' . $exception->getMessage());
            }

            return null;
        }

        public function loginUser(): bool {
            $username = trim($this->username);
            $password = $this->password;

            if ($username === '' || $password === '') {
                return false;
            }

            $pdo = $this->dbConnect();

            if ($pdo === null) {
                return false;
            }

            try {
                $statement = $pdo->prepare('SELECT * FROM User WHERE username = :username');
                $statement->execute(['username' => $username]);
                $user = $statement->fetch();

                if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
                    if (session_status() !== PHP_SESSION_ACTIVE) {
                        session_start();
                    }

                    if (isset($user['id'])) {
                        $_SESSION['user_id'] = $user['id'];
                    }

                    $_SESSION['username'] = $user['username'] ?? $username;

                    return true;
                }
            } catch (PDOException $exception) {
                error_log('Login failed: ' . $exception->getMessage());
            }

            return false;
        }

        // Check if the user is already logged in
        public function isLoggedin(): bool {
            // Check if user session has been set
            
            return false;
        }

        public function getUser(string $username): bool {
            // Connect database

		    // Doe SELECT * from user WHERE username = $username

            if (false){
                //Indien gevonden eigenschappen vullen met waarden uit de SELECT
                $this->username = 'Waarde uit de database';
                return true;
            } else {
                return false;
            }   
        }

        public function logout(){
            session_start();
            // remove all session variables
           

            // destroy the session
            

        }


    }

?>