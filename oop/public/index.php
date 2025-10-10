<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/Product.php';
require_once __DIR__ . '/../src/FoodProduct.php';
require_once __DIR__ . '/../src/DrinkProduct.php';
require_once __DIR__ . '/../src/ProductList.php';

use App\Models\DrinkProduct;
use App\Models\FoodProduct;
use App\Models\ProductList;

$margherita = new FoodProduct('Margherita Pizza', 8.95, 'Main', 760);
$veggieWrap = new FoodProduct('Veggie Wrap', 6.50, 'Starter', 420);
$cola = new DrinkProduct('Cola', 2.50, 'SoftDrink', true);
$herbalTea = new DrinkProduct('Herbal Tea', 3.10, 'HotDrink', false);

$list = new ProductList();
$list->add($margherita);
$list->add($veggieWrap);
$list->add($cola);
$list->add($herbalTea);

$products = $list->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Overview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 2rem;
        }
        .product {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
        }
        .product h2 {
            margin: 0 0 0.5rem;
        }
        .price {
            font-weight: bold;
            color: #2b7a0b;
        }
    </style>
</head>
<body>
    <h1>Product Overview</h1>
    <?php foreach ($products as $product): ?>
        <div class="product">
            <h2><?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?></h2>
            <p class="price">€<?php echo number_format($product->getPrice(), 2, ',', '.'); ?></p>
            <p>Category: <?php echo htmlspecialchars($product->getCategory(), ENT_QUOTES, 'UTF-8'); ?></p>
            <p><?php echo htmlspecialchars($product->getInfo(), ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
