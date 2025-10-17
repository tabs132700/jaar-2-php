<?php

declare(strict_types=1);

use App\Database;
use App\User;

require __DIR__ . '/../src/Database.php';
require __DIR__ . '/../src/User.php';

$dsn = getenv('DB_DSN') ?: 'mysql:host=localhost;dbname=login_app;charset=utf8mb4';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPassword = getenv('DB_PASSWORD') ?: '';

$database = new Database($dsn, $dbUser, $dbPassword);
$userService = new User($database);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Please provide both email and password.';
    } elseif ($userService->loginUser($email, $password)) {
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid email or password.';
    }
}

require __DIR__ . '/../templates/login_form.php';
