<?php
require_once __DIR__ . '/../src/Model/Acteur.php';

$actors = [];
$error = null;
try {
    $actors = Acteur::getAll();
} catch (Throwable $e) {
    $error = $e->getMessage();
}
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Overzicht acteurs</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <main class="container">
      <div class="card">
        <h1>Overzicht acteurs</h1>
        <p class="small"><a href="index.php">Terug naar menu</a> | <a href="acteur_create.php">Nieuwe acteur</a></p>

        <?php if ($error): ?>
          <div class="alert alert-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!$actors): ?>
            <tr><td colspan="2">Geen acteurs gevonden.</td></tr>
        <?php else: ?>
            <?php foreach ($actors as $a): ?>
                <tr>
                    <td><?php echo (int)$a->id; ?></td>
                    <td><?php echo htmlspecialchars($a->naam, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        </table>
      </div>
    </main>
  </body>
  </html>
