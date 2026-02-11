<?php

class GameList
{
    /** @var Game[] */
    private array $games = [];

    public function addGame(Game $game): void
    {
        $this->games[] = $game;
    }

    /**
     * @return Game[]
     */
    public function getGames(): array
    {
        return $this->games;
    }

    public function getCurrentGame(): ?Game
    {
        if (empty($this->games)) {
            return null;
        }
        return $this->games[count($this->games) - 1];
    }

    public function getAmountGames(): int
    {
        return count($this->games);
    }
}
