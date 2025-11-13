<?php
require_once __DIR__ . '/../src/Model/Film.php';

$errors = [];
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = trim($_POST['naam'] ?? '');
    $genre = trim($_POST['genre'] ?? '');

    if ($naam === '') { $errors[] = 'Naam is verplicht.'; }
    if ($genre === '') { $errors[] = 'Genre is verplicht.'; }

    if (!$errors) {
        try {
            $film = new Film(null, $naam, $genre);
            if ($film->save()) {
                $success = 'Film succesvol toegevoegd.';
                $naam = '';
                $genre = '';
            } else {
                $errors[] = 'Opslaan mislukt.';
            }
        } catch (Throwable $e) {
            $errors[] = 'Fout: ' . $e->getMessage();
        }
    }
}
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Film toevoegen</title>
    <link rel="stylesheet" href="assets/style.css">
  </head>
  <body>
    <main class="container">
      <div class="card">
        <h1>Film toevoegen</h1>
        <p class="small"><a href="index.php">Terug naar menu</a></p>

        <?php if ($success): ?>
          <div class="alert alert-success"><?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <?php if ($errors): ?>
          <div class="alert alert-error">
            <ul>
              <?php foreach ($errors as $e): ?>
                <li><?php echo htmlspecialchars($e, ENT_QUOTES, 'UTF-8'); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <form method="post">
          <label>Naam
            <input type="text" name="naam" value="<?php echo htmlspecialchars($naam ?? '', ENT_QUOTES, 'UTF-8'); ?>">
          </label>
          <label>Genre
            <input type="text" name="genre" value="<?php echo htmlspecialchars($genre ?? '', ENT_QUOTES, 'UTF-8'); ?>">
          </label>
          <div class="actions">
            <button type="submit">Opslaan</button>
          </div>
        </form>
      </div>
    </main>
  </body>
  </html>
