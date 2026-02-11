<?php

class Game
{
    private CubeList $cubeList;
    private TurnList $turnList;
    private int $resultIceHoles = 0;
    private int $resultPolarBears = 0;
    private int $resultPenguins = 0;
    private bool $guessed = false;
    private bool $correct = false;
    private bool $locked = false; // oplossing gevraagd

    public function __construct(int $amount)
    {
        $this->cubeList = new CubeList();

        for ($i = 0; $i < $amount; $i++) {
            $cube = new Cube($i + 1);
            $cube->dice();
            $this->cubeList->addCube($cube);
        }

        $this->turnList = new TurnList();
        $this->calculateResult();
    }

    private function calculateResult(): void
    {
        foreach ($this->cubeList->getCubes() as $cube) {
            $this->resultIceHoles   += $cube->getIceHoles();
            $this->resultPolarBears += $cube->getPolarBears();
            $this->resultPenguins   += $cube->getPenguins();
        }
    }

    public function drawCubes(): string
    {
        $html = '';
        foreach ($this->cubeList->getCubes() as $cube) {
            $html .= $cube->draw();
        }
        return $html;
    }

    public function addGuess(int $iceHoles, int $polarBears, int $penguins): ?Turn
    {
        if ($this->locked) {
            return null;
        }

        if ($this->guessed) {
            return $this->turnList->getCurrentTurn();
        }

        $turn = new Turn($iceHoles, $polarBears, $penguins);
        $this->turnList->addTurn($turn);
        $this->guessed = true;

        if ($turn->matches($this->resultIceHoles, $this->resultPolarBears, $this->resultPenguins)) {
            $this->correct = true;
        }

        return $turn;
    }

    public function checkGuess(): bool
    {
        return $this->correct;
    }

    public function revealAnswer(): array
    {
        $this->locked = true;

        return [
            'iceHoles'   => $this->resultIceHoles,
            'polarBears' => $this->resultPolarBears,
            'penguins'   => $this->resultPenguins,
        ];
    }

    public function getAnswer(): array
    {
        return [
            'iceHoles'   => $this->resultIceHoles,
            'polarBears' => $this->resultPolarBears,
            'penguins'   => $this->resultPenguins,
        ];
    }

    public function getGameTurns(): int
    {
        return $this->turnList->getAmountTurns();
    }

    public function getWrongAnswers(): int
    {
        if (!$this->guessed) {
            return 0;
        }
        return $this->correct ? 0 : 1;
    }

    public function getScore(): int
    {
        return $this->correct ? 1 : 0;
    }
}
