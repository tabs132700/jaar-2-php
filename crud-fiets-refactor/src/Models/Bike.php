<?php
declare(strict_types=1);

namespace App\Models;

final class Bike
{
    public function __construct(
        public ?int $id,
        public string $merk,
        public string $type,
        public int $prijs,
        public string $foto
    ) {}
}
