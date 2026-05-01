CREATE OR REPLACE FUNCTION ajout_client(
    p_nom         TEXT,
    p_prenom      TEXT,
    p_email       TEXT,
    p_mot_de_passe TEXT
) RETURNS INT AS
       '
DECLARE
    v_id INT;
BEGIN
    INSERT INTO client(nom, prenom, email, mot_de_passe)
    VALUES (p_nom, p_prenom, p_email, p_mot_de_passe)
        RETURNING id_client INTO v_id;
    RETURN v_id;
END;
' LANGUAGE 'plpgsql';