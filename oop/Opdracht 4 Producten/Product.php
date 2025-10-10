<?php

declare(strict_types=1);

namespace App\Models;

use InvalidArgumentException;

abstract class Product
{
    private string $name;

    private float $price;

    private string $category;

    public function __construct(string $name, float $price, string $category)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setCategory($category);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $trimmed = trim($name);

        if ($trimmed === '') {
            throw new InvalidArgumentException('Name cannot be empty.');
        }

        $this->name = $trimmed;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        if ($price < 0) {
            throw new InvalidArgumentException('Price cannot be negative.');
        }

        $this->price = $price;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    protected function assignCategory(string $category): void
    {
        $this->category = $category;
    }

    abstract public function setCategory(string $category): void;

    abstract public function getInfo(): string;
}
