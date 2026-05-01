CREATE OR REPLACE FUNCTION ajout_contenu_commande(
    p_quantite_achetee INT,
    p_prix_unitaire    FLOAT,
    p_id_commande      INT,
    p_id_info_pointure INT
) RETURNS INT AS '
DECLARE
    v_id INT;
BEGIN
    INSERT INTO contenu_commande(quantite_achetee, prix_unitaire, id_commande, id_info_pointure)
    VALUES (p_quantite_achetee, p_prix_unitaire, p_id_commande, p_id_info_pointure)
    RETURNING id_contenu_commande INTO v_id;
    RETURN v_id;
END;
' LANGUAGE 'plpgsql';