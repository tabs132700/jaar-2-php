<?php
require __DIR__ . '/Cube.php';
require __DIR__ . '/CubeList.php';
require __DIR__ . '/Game.php';
require __DIR__ . '/GameList.php';
require __DIR__ . '/Hint.php';
require __DIR__ . '/HintList.php';
require __DIR__ . '/Turn.php';
require __DIR__ . '/TurnList.php';
require __DIR__ . '/Play.php';

session_start();


if (!isset($_SESSION['play']) || !($_SESSION['play'] instanceof Play)) {
    $_SESSION['play'] = new Play();
}

$play = $_SESSION['play'];

$message = '';
$hintMsg = '';
$answerArray = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['reset'])) {
        $play->reset();
    }

    if (isset($_POST['newGame']) && isset($_POST['cubes'])) {
        $amount = (int)$_POST['cubes'];
        $play->addGame($amount);
    }

    if (isset($_POST['guess'])) {
        if (
            is_numeric($_POST['iceholes']) &&
            is_numeric($_POST['polarbears']) &&
            is_numeric($_POST['penguins'])
        ) {
            $res = $play->makeGuess(
                (int)$_POST['iceholes'],
                (int)$_POST['polarbears'],
                (int)$_POST['penguins']
            );

            $message = $res['message'];

            if (!empty($res['hint'])) {
                $hintMsg = $res['hint'];
            }

        } else {
            $message = "Voer geldige getallen in!";
        }
    }

    if (isset($_POST['answer'])) {
        $answer = $play->revealAnswer();
        if ($answer) {
            $message = "Oplossing: {$answer['iceHoles']} wakken, {$answer['polarBears']} ijsberen, {$answer['penguins']} pinguïns.";
        }
    }

    if (isset($_POST['name']) && $_POST['name'] !== '') {
        $play->setPlayerName($_POST['name']);
    }

    $_SESSION['play'] = $play;
}
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Wakken en IJsberen - Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

    <h1 class="text-center mb-4">Wakken & IJsberen</h1>

    <div class="row">
        <div class="col-lg-4">

            <div class="card p-3 mb-3">
                <h5>Speler</h5>
                <form method="post">
                    <label>Naam:</label>
                    <input class="form-control mb-2" type="text" name="name" value="<?php echo htmlspecialchars($play->getPlayerName()); ?>">
                    <label>Aantal dobbelstenen (3-8):</label>
                    <input class="form-control mb-2" type="number" min="3" max="8" name="cubes" value="3">
                    <button class="btn btn-primary w-100 mb-2" name="newGame">Nieuwe Worp</button>
                    <button class="btn btn-danger w-100" name="reset">Reset Alles</button>
                </form>
            </div>

        </div>

        <div class="col-lg-8">
            
            <div class="card p-3 mb-3">
                <h5>Dobbelstenen</h5>
                <div class="d-flex flex-wrap">
                    <?php
                    $game = $play->getCurrentGame();
                    if ($game) echo $game->drawCubes();
                    ?>
                </div>
            </div>

            <div class="card p-3 mb-3">
                <h5>Raden</h5>
                <form method="post" class="row g-2">
                    <div class="col-md-4">
                        <label>Wakken</label>
                        <input type="number" name="iceholes" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>IJsberen</label>
                        <input type="number" name="polarbears" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Pinguïns</label>
                        <input type="number" name="penguins" class="form-control">
                    </div>
                    <div class="col-12 mt-2">
                        <button name="guess" class="btn btn-success">Raad</button>
                        <button name="answer" class="btn btn-secondary">Oplossing</button>
                    </div>
                </form>

                <?php if ($message): ?>
                    <div class="alert alert-info mt-3"><?php echo $message; ?></div>
                <?php endif; ?>

                <?php if ($hintMsg): ?>
                    <div class="alert alert-warning mt-2">Hint: <?php echo $hintMsg; ?></div>
                <?php endif; ?>
            </div>


            <div class="card p-3">
                <h5>Statistieken</h5>
                <p>Games gespeeld: <?php echo $play->getTotalGames(); ?></p>
                <p>Totaal raden: <?php echo $play->getTotalGuesses(); ?></p>
                <p>Goed geraden: <?php echo $play->getTotalCorrect(); ?></p>
                <p>Fout geraden: <?php echo $play->getTotalWrong(); ?></p>
            </div>

        </div>
    </div>

</div>

</body>
</html>
