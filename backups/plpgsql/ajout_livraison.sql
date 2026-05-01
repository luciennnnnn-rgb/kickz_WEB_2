CREATE OR REPLACE FUNCTION ajout_livraison(
    p_date_prevue DATE,
    p_num_suivi   TEXT,
    p_id_commande INT,
    p_id_adresse  INT
) RETURNS INT AS '
DECLARE
v_id INT;
BEGIN
INSERT INTO livraison(date_prevue, num_suivi, id_commande, id_adresse)
VALUES (p_date_prevue, p_num_suivi, p_id_commande, p_id_adresse)
    RETURNING id_livraison INTO v_id;
RETURN v_id;
END;
'LANGUAGE 'plpgsql';