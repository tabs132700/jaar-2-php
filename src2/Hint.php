<?php

class Hint
{
    private string $hintString;

    public function __construct(string $hint)
    {
        $this->hintString = $hint;
    }

    public function getHintString(): string
    {
        return $this->hintString;
    }

    public function __toString(): string
    {
        return $this->hintString;
    }
}
