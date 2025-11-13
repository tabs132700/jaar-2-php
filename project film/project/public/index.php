<?php ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Film Registratie Systeem</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <main class="container">
        <div class="card">
            <h1>Film Registratie Systeem</h1>
            <p class="small muted">Kies een actie hieronder.</p>
            <ul class="menu">
                <li><a href="film_create.php">Film toevoegen</a></li>
                <li><a href="film_list.php">Overzicht films</a></li>
                <li><a href="acteur_create.php">Acteur toevoegen</a></li>
                <li><a href="acteur_list.php">Overzicht acteurs</a></li>
                <li><a href="koppeling_create.php">Acteur koppelen aan film</a></li>
                <li><a href="film_overview.php">Films met gekoppelde acteurs</a></li>
            </ul>
        </div>
    </main>
</body>
</html>
