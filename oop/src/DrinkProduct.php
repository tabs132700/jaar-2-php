<?php

declare(strict_types=1);

namespace App\Models;

use InvalidArgumentException;

class DrinkProduct extends Product
{
    private bool $isCold;

    public function __construct(string $name, float $price, string $category, bool $isCold)
    {
        parent::__construct($name, $price, $category);
        $this->isCold = $isCold;
    }

    public function setCategory(string $category): void
    {
        $allowedCategories = ['SoftDrink', 'Juice', 'HotDrink'];

        if (!in_array($category, $allowedCategories, true)) {
            throw new InvalidArgumentException('Invalid drink category provided.');
        }

        $this->assignCategory($category);
    }

    public function getInfo(): string
    {
        $price = number_format($this->getPrice(), 2, ',', '.');
        $temperature = $this->isCold ? 'Cold' : 'Hot';

        return sprintf(
            '%s - €%s (%s) | Serving: %s',
            $this->getName(),
            $price,
            $this->getCategory(),
            $temperature
        );
    }

    public function isCold(): bool
    {
        return $this->isCold;
    }
}
