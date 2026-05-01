CREATE OR REPLACE FUNCTION update_statut_commande(
    p_id_commande      INT,
    p_statut_livraison BOOLEAN
) RETURNS VOID AS '
BEGIN
UPDATE commande SET statut_livraison = p_statut_livraison
WHERE id_commande = p_id_commande;
END;
'LANGUAGE 'plpgsql';