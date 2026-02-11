<?php
require_once __DIR__ . '/../src/Model/Film.php';
require_once __DIR__ . '/../src/Model/Acteur.php';
require_once __DIR__ . '/../src/Model/FilmActeur.php';

$films = [];
$actors = [];
$errors = [];
$success = null;

try {
    $films = Film::getAll();
    $actors = Acteur::getAll();
} catch (Throwable $e) {
    $errors[] = $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $film_id = isset($_POST['film_id']) ? (int)$_POST['film_id'] : 0;
    $acteur_id = isset($_POST['acteur_id']) ? (int)$_POST['acteur_id'] : 0;

    if ($film_id <= 0) { $errors[] = 'Selecteer een film.'; }
    if ($acteur_id <= 0) { $errors[] = 'Selecteer een acteur.'; }

    if (!$errors) {
        try {
            if (FilmActeur::link($film_id, $acteur_id)) {
                $success = 'Acteur succesvol gekoppeld aan film.';
            } else {
                $errors[] = 'Koppeling mislukt.';
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
    <title>Acteur koppelen aan film</title>
    <link rel="stylesheet" href="assets/style.css">
  </head>
  <body>
    <main class="container">
      <div class="card">
        <h1>Acteur koppelen aan film</h1>
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
          <label>Film
            <select name="film_id">
              <option value="">-- Kies film --</option>
              <?php foreach ($films as $f): ?>
                <option value="<?php echo (int)$f->id; ?>" <?php echo (isset($film_id) && $film_id === (int)$f->id) ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($f->naam . ' (' . $f->genre . ')', ENT_QUOTES, 'UTF-8'); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </label>

          <label>Acteur
            <select name="acteur_id">
              <option value="">-- Kies acteur --</option>
              <?php foreach ($actors as $a): ?>
                <option value="<?php echo (int)$a->id; ?>" <?php echo (isset($acteur_id) && $acteur_id === (int)$a->id) ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($a->naam, ENT_QUOTES, 'UTF-8'); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </label>

          <div class="actions">
            <button type="submit">Koppelen</button>
          </div>
        </form>
      </div>
    </main>
  </body>
  </html>
