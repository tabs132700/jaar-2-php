<?php

class Cube
{
    private int $cubeNr;
    private int $dice = 1;
    private int $iceHoles = 0;
    private int $polarBears = 0;
    private int $penguins = 0;

    public function __construct(int $nr = 0)
    {
        $this->cubeNr = $nr;
    }

    public function dice(): void
    {
        $this->dice = rand(1, 6);

        if ($this->dice === 1) {
            $this->iceHoles = 1;
            $this->polarBears = 0;
            $this->penguins = 6;
        } elseif ($this->dice === 3) {
            $this->iceHoles = 1;
            $this->polarBears = 2;
            $this->penguins = 4;
        } elseif ($this->dice === 5) {
            $this->iceHoles = 1;
            $this->polarBears = 4;
            $this->penguins = 2;
        } else {
            $this->iceHoles = 0;
            $this->polarBears = 0;
            $this->penguins = 0;
        }
    }

    public function getDice(): int
    {
        return $this->dice;
    }

    public function getIceHoles(): int
    {
        return $this->iceHoles;
    }

    public function getPolarBears(): int
    {
        return $this->polarBears;
    }

    public function getPenguins(): int
    {
        return $this->penguins;
    }

    public function draw(): string
    {
        $svg  = '<svg width="90" height="90" viewBox="0 0 100 100" style="margin:5px">';
        $svg .= '<rect x="5" y="5" width="90" height="90" rx="15" ry="15" fill="white" stroke="black" stroke-width="4" />';

        $pips = [];

        switch ($this->dice) {
            case 1:
                $pips = [[50, 50]];
                break;
            case 2:
                $pips = [[25, 25], [75, 75]];
                break;
            case 3:
                $pips = [[25, 25], [50, 50], [75, 75]];
                break;
            case 4:
                $pips = [[25, 25], [75, 25], [25, 75], [75, 75]];
                break;
            case 5:
                $pips = [[25, 25], [75, 25], [50, 50], [25, 75], [75, 75]];
                break;
            case 6:
                $pips = [[25, 25], [75, 25], [25, 50], [75, 50], [25, 75], [75, 75]];
                break;
        }

        foreach ($pips as $pip) {
            $svg .= '<circle cx="' . $pip[0] . '" cy="' . $pip[1] . '" r="6" fill="black" />';
        }

        $svg .= '</svg>';

        return $svg;
    }
}
