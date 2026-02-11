<?php
require_once __DIR__ . '/../src/Model/Film.php';

$films = [];
$error = null;
try {
    $films = Film::getAll();
} catch (Throwable $e) {
    $error = $e->getMessage();
}
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Overzicht films</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <main class="container">
      <div class="card">
        <h1>Overzicht films</h1>
        <p class="small"><a href="index.php">Terug naar menu</a> | <a href="film_create.php">Nieuwe film</a></p>

        <?php if ($error): ?>
          <div class="alert alert-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!$films): ?>
            <tr><td colspan="3">Geen films gevonden.</td></tr>
        <?php else: ?>
            <?php foreach ($films as $f): ?>
                <tr>
                    <td><?php echo (int)$f->id; ?></td>
                    <td><?php echo htmlspecialchars($f->naam, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($f->genre, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        </table>
      </div>
    </main>
  </body>
  </html>
