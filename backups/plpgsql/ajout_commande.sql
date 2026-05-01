CREATE OR REPLACE FUNCTION ajout_commande(
    p_id_client INT
) RETURNS INT AS'
DECLARE
v_id INT;
BEGIN
INSERT INTO commande(id_client)
VALUES (p_id_client)
    RETURNING id_commande INTO v_id;
RETURN v_id;
END;
'LANGUAGE 'plpgsql';