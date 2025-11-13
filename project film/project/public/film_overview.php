<?php
require_once __DIR__ . '/../src/Model/Film.php';
require_once __DIR__ . '/../src/Model/FilmActeur.php';

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
    <title>Films met acteurs</title>
    <link rel="stylesheet" href="assets/style.css">
  </head>
  <body>
    <main class="container">
      <div class="card">
        <h1>Films met gekoppelde acteurs</h1>
        <p class="small"><a href="index.php">Terug naar menu</a></p>

        <?php if ($error): ?>
          <div class="alert alert-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <?php if (!$films): ?>
          <p class="muted">Geen films gevonden.</p>
        <?php else: ?>
          <?php foreach ($films as $f): ?>
            <section style="margin-bottom: 1rem;">
              <h2>
                <?php echo htmlspecialchars($f->naam, ENT_QUOTES, 'UTF-8'); ?>
                <small class="muted">(<?php echo htmlspecialchars($f->genre, ENT_QUOTES, 'UTF-8'); ?>)</small>
              </h2>
              <?php
              try {
                  $actors = FilmActeur::getActeursByFilm((int)$f->id);
              } catch (Throwable $e) {
                  $actors = [];
                  echo '<p class="alert alert-error">' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
              }
              ?>
              <?php if (!$actors): ?>
                <p class="muted"><em>Geen acteurs gekoppeld.</em></p>
              <?php else: ?>
                <ul>
                  <?php foreach ($actors as $a): ?>
                    <li><?php echo htmlspecialchars($a->naam, ENT_QUOTES, 'UTF-8'); ?></li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </section>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </main>
  </body>
  </html>
