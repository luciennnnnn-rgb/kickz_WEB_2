CREATE OR REPLACE FUNCTION ajout_chaussure(
    p_modele      TEXT,
    p_marque      TEXT,
    p_prix        FLOAT,
    p_description TEXT
) RETURNS INT AS '
DECLARE
    v_id INT;
BEGIN
    INSERT INTO chaussure(modele, marque, prix, description)
    VALUES (p_modele, p_marque, p_prix, p_description)
    RETURNING id_chaussure INTO v_id;
    RETURN v_id;
END;
'LANGUAGE 'plpgsql';