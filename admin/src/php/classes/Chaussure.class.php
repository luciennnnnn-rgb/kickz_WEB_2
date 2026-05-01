<?php
declare(strict_types=1);

class Chaussure
{
    public function __construct(
        public readonly int    $id_chaussure,
        public readonly string $modele,
        public readonly string $marque,
        public readonly float  $prix,
        public readonly string $description,
    ) {}
}
