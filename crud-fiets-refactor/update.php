<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Database\Database;
use App\Models\Bike;
use App\Repositories\BikeRepository;

$db = new Database();
$repo = new BikeRepository($db->getConnection());

$id = (int)($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $merk = trim((string)($_POST['merk'] ?? ''));
    $type = trim((string)($_POST['type'] ?? ''));
    $prijs = (int)($_POST['prijs'] ?? 0);
    $foto = trim((string)($_POST['foto'] ?? ''));

    $repo->update(new Bike($id, $merk, $type, $prijs, $foto));
    header('Location: index.php');
    exit;
}

$bike = $repo->getById($id);
if ($bike === null) {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTFutf">
    <title>Edit fiets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Fiets aanpassen</h1>

<form method="post">
    <label>Merk</label><input type="text" name="merk" value="<?= htmlspecialchars($bike->merk) ?>" required><br>
    <label>Type</label><input type="text" name="type" value="<?= htmlspecialchars($bike->type) ?>" required><br>
    <label>Prijs</label><input type="number" name="prijs" value="<?= (int)$bike->prijs ?>" required><br>
    <label>Foto</label><input type="text" name="foto" value="<?= htmlspecialchars($bike->foto) ?>"><br>
    <button type="submit">Opslaan</button>
    <a href="index.php">Back</a>
</form>

</body>
</html>
