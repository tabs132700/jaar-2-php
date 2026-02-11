<?php

class TurnList
{
    /** @var Turn[] */
    private array $turns = [];

    public function addTurn(Turn $turn): void
    {
        $this->turns[] = $turn;
    }

    /**
     * @return Turn[]
     */
    public function getTurns(): array
    {
        return $this->turns;
    }

    public function getAmountTurns(): int
    {
        return count($this->turns);
    }

    public function getCurrentTurn(): ?Turn
    {
        if (empty($this->turns)) {
            return null;
        }
        return $this->turns[count($this->turns) - 1];
    }
}
