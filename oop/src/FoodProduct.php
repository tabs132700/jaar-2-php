<?php

declare(strict_types=1);

namespace App\Models;

use InvalidArgumentException;

class FoodProduct extends Product
{
    private int $calories;

    public function __construct(string $name, float $price, string $category, int $calories)
    {
        parent::__construct($name, $price, $category);
        $this->setCalories($calories);
    }

    public function setCategory(string $category): void
    {
        $allowedCategories = ['Starter', 'Main', 'Dessert'];

        if (!in_array($category, $allowedCategories, true)) {
            throw new InvalidArgumentException('Invalid food category provided.');
        }

        $this->assignCategory($category);
    }

    public function getInfo(): string
    {
        $price = number_format($this->getPrice(), 2, ',', '.');

        return sprintf(
            '%s - €%s (%s) | Calories: %d kcal',
            $this->getName(),
            $price,
            $this->getCategory(),
            $this->calories
        );
    }

    public function getCalories(): int
    {
        return $this->calories;
    }

    public function setCalories(int $calories): void
    {
        if ($calories < 0) {
            throw new InvalidArgumentException('Calories cannot be negative.');
        }

        $this->calories = $calories;
    }
}
