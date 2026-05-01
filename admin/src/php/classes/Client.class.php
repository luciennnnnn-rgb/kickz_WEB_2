<?php
declare(strict_types=1);

class Client
{
    public function __construct(
        public readonly int    $id_client,
        public readonly string $nom,
        public readonly string $prenom,
        public readonly string $email,
        public readonly string $mot_de_passe,
    ) {}
}
