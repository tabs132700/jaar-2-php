<?php

class Play
{
    private string $name = '';
    private GameList $gameList;
    private HintList $hintList;
    private int $totalGuesses = 0;
    private int $totalCorrect = 0;
    private int $totalWrong = 0;

    public function __construct()
    {
        $this->gameList = new GameList();
        $this->hintList = new HintList();
        $this->setHints();
    }

    public function reset(): void
    {
        $this->gameList      = new GameList();
        $this->totalGuesses  = 0;
        $this->totalCorrect  = 0;
        $this->totalWrong    = 0;
    }

    private function setHints(): void
    {
        $hints = [
            'Ijsberen staan alleen om een wak.',
            'Er is alleen een wak bij 1, 3 of 5.',
            'Pinguins zitten aan de onderkant als er een wak is.',
            'Som van boven en onder van de dobbelsteen is 7.',
        ];

        foreach ($hints as $hint) {
            $this->hintList->addHint(new Hint($hint));
        }
    }

    public function setPlayerName(string $name): void
    {
        $this->name = trim($name);
    }

    public function getPlayerName(): string
    {
        return $this->name;
    }

    public function addGame(int $amount): void
    {
        if ($amount < 3) {
            $amount = 3;
        }
        if ($amount > 8) {
            $amount = 8;
        }
        $game = new Game($amount);
        $this->gameList->addGame($game);
    }

    public function getCurrentGame(): ?Game
    {
        return $this->gameList->getCurrentGame();
    }

    public function makeGuess(int $iceHoles, int $polarBears, int $penguins): array
    {
        $game = $this->getCurrentGame();
        if ($game === null) {
            return [
                'correct' => false,
                'message' => 'Je moet eerst een spel starten.',
                'hint'    => null,
            ];
        }

        $turn = $game->addGuess($iceHoles, $polarBears, $penguins);
        if ($turn === null) {
            return [
                'correct' => false,
                'message' => 'Je hebt al de oplossing gevraagd, je mag niet meer raden voor deze worp.',
                'hint'    => null,
            ];
        }

        $this->totalGuesses++;

        if ($game->checkGuess()) {
            $this->totalCorrect++;
            return [
                'correct' => true,
                'message' => 'Goed geraden.',
                'hint'    => null,
            ];
        }

        $this->totalWrong++;
        $msg = 'Helaas is je antwoord niet goed.';
        $hint = null;

        if ($this->totalWrong % 3 === 0) {
            $hintObj = $this->hintList->getRandomHint();
            $hint = $hintObj->getHintString();
        }

        return [
            'correct' => false,
            'message' => $msg,
            'hint'    => $hint,
        ];
    }

    public function revealAnswer(): ?array
    {
        $game = $this->getCurrentGame();
        if ($game === null) {
            return null;
        }
        return $game->revealAnswer();
    }

    public function getPreviousGames(): array
    {
        $games = $this->gameList->getGames();
        if (count($games) <= 1) {
            return [];
        }
        return array_slice($games, 0, count($games) - 1);
    }

    public function getTotalGames(): int
    {
        return $this->gameList->getAmountGames();
    }

    public function getTotalGuesses(): int
    {
        return $this->totalGuesses;
    }

    public function getTotalCorrect(): int
    {
        return $this->totalCorrect;
    }

    public function getTotalWrong(): int
    {
        return $this->totalWrong;
    }

    public function getScore(): int
    {
        return $this->totalCorrect;
    }

    public function getHint(): string
    {
        return $this->hintList->getRandomHint()->getHintString();
    }
}
