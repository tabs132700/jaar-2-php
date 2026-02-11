<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Database\Database;
use App\Repositories\BikeRepository;

$id = (int)($_GET['id'] ?? 0);

$db = new Database();
$repo = new BikeRepository($db->getConnection());

if ($id > 0) {
    $repo->delete($id);
}

header('Location: index.php');
exit;
