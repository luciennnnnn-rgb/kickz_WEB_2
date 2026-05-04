<?php
declare(strict_types=1);

class ContenuCommande
{
    public function __construct(
        public readonly int   $id_contenu_commande,
        public readonly int   $quantite_achetee,
        public readonly float $prix_unitaire,
        public readonly int   $id_commande,
        public readonly int   $id_info_pointure,
    ) {}
}