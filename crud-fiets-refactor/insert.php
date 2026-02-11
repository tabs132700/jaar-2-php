<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Database\Database;
use App\Models\Bike;
use App\Repositories\BikeRepository;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$merk = trim((string)($_POST['merk'] ?? ''));
$type = trim((string)($_POST['type'] ?? ''));
$prijs = (int)($_POST['prijs'] ?? 0);
$foto = trim((string)($_POST['foto'] ?? ''));

$db = new Database();
$repo = new BikeRepository($db->getConnection());

$repo->create(new Bike(null, $merk, $type, $prijs, $foto));

header('Location: index.php');
exit;
