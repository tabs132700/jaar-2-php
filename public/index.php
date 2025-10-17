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

if (isset($_GET['logout'])) {
    $userService->logoutUser();
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'] ?? null;

if (!$user) {
    header('Location: login.php');
    exit;
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>!</h1>
    <p><a href="?logout=1">Logout</a></p>
</body>
</html>
