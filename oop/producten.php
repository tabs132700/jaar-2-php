<?php

// Importeer de Product- en Categorie-klassen
require_once __DIR__ . '/Product.php';

// Maak categorieën aan
$hoofdgerecht = new Categorie('Hoofdgerecht', 'Warme gerechten voor de hoofdmaaltijd.');
$vegetarisch = new Categorie('Vegetarisch', 'Heerlijke vegetarische gerechten.');

// Maak producten aan met hun categorieën
$pizza = new Product(
    'Pizza Margherita',
    9.5,
    'Een klassieke pizza met tomatensaus, mozzarella en verse basilicum.',
    $hoofdgerecht
);

$shawarma = new Product(
    'Shawarma',
    11.0,
    'Gekruid lamsvlees geserveerd met knoflooksaus, verse groenten en pita.',
    $hoofdgerecht
);

$falafel = new Product(
    'Falafel',
    7.75,
    'Knapperige falafelballetjes met hummus en salade.',
    $vegetarisch
);

// Verzameling van alle producten
$producten = [$pizza, $shawarma, $falafel];

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Producten</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 2rem;
        }

        h1 {
            text-align: center;
        }

        .productoverzicht {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        }

        .product {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
        }

        .product__naam {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        .product__categorie,
        .product__prijs {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .product__beschrijving {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<h1>Overzicht van producten</h1>
<div class="productoverzicht">
    <?php foreach ($producten as $product): ?>
        <!-- Toon elk product met behulp van de methode toonProduct -->
        <?php echo $product->toonProduct(); ?>
    <?php endforeach; ?>
</div>
</body>
</html>
