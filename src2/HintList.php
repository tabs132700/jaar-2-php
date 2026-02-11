<?php

class HintList
{
    /** @var Hint[] */
    private array $hints = [];

    public function addHint(Hint $hint): void
    {
        $this->hints[] = $hint;
    }

    /**
     * @return Hint[]
     */
    public function getHints(): array
    {
        return $this->hints;
    }

    public function getRandomHint(): Hint
    {
        if (empty($this->hints)) {
            return new Hint('Er zijn geen hints ingesteld.');
        }

        $index = array_rand($this->hints);
        return $this->hints[$index];
    }
}
