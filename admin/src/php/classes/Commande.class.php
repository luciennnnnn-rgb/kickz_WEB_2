<?php
declare(strict_types=1);

class Commande
{
    public function __construct(
        public readonly int    $id_commande,
        public readonly string $date_achat,
        public readonly bool   $statut_livraison,
        public readonly int    $id_client,
    ) {}
}
