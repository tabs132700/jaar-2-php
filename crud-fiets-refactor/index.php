<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Database\Database;
use App\Repositories\BikeRepository;

$db = new Database();
$repo = new BikeRepository($db->getConnection());

$bikes = $repo->getAll();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Fietsen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Fietsen</h1>

<h2>Nieuwe fiets toevoegen</h2>
<form method="post" action="insert.php">
    <label>Merk</label><input type="text" name="merk" required><br>
    <label>Type</label><input type="text" name="type" required><br>
    <label>Prijs</label><input type="number" name="prijs" required><br>
    <label>Foto</label><input type="text" name="foto" placeholder="Fiets1.jpg"><br>
    <button type="submit">Toevoegen</button>
</form>

<h2>Overzicht</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Merk</th>
        <th>Type</th>
        <th>Prijs</th>
        <th>Foto</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($bikes as $bike): ?>
        <tr>
            <td><?= htmlspecialchars((string)$bike['id']) ?></td>
            <td><?= htmlspecialchars((string)$bike['merk']) ?></td>
            <td><?= htmlspecialchars((string)$bike['type']) ?></td>
            <td><?= htmlspecialchars((string)$bike['prijs']) ?></td>
            <td><?= htmlspecialchars((string)$bike['foto']) ?></td>
            <td>
                <a href="update.php?id=<?= (int)$bike['id'] ?>">Edit</a>
                |
                <a href="delete.php?id=<?= (int)$bike['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
