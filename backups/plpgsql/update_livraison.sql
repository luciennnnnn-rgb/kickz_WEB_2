CREATE OR REPLACE FUNCTION update_livraison(
    p_id_livraison INT,
    p_date_reelle  DATE,
    p_num_suivi    TEXT
) RETURNS VOID AS'
BEGIN
    UPDATE livraison
    SET date_reelle = p_date_reelle, num_suivi = p_num_suivi
    WHERE id_livraison = p_id_livraison;
END;
' LANGUAGE 'plpgsql';