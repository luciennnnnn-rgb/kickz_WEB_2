CREATE OR REPLACE FUNCTION ajout_adresse(
    p_num_rue     INT,
    p_nom_rue     TEXT,
    p_code_postal TEXT,
    p_ville       TEXT,
    p_id_client   INT
) RETURNS INT AS '
DECLARE
    v_id INT;
BEGIN
    INSERT INTO adresse(num_rue, nom_rue, code_postal, ville, id_client)
    VALUES (p_num_rue, p_nom_rue, p_code_postal, p_ville, p_id_client)
    RETURNING id_adresse INTO v_id;
    RETURN v_id;
END;
'LANGUAGE 'plpgsql';