<?php

declare(strict_types=1);

namespace App\Models;

class ProductList
{
    /**
     * @var Product[]
     */
    private array $items = [];

    public function add(Product $product): void
    {
        $this->items[] = $product;
    }

    /**
     * @return Product[]
     */
    public function all(): array
    {
        return $this->items;
    }
}
