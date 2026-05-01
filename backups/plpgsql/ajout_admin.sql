CREATE OR REPLACE FUNCTION ajout_admin(
    p_login        TEXT,
    p_mot_de_passe TEXT
) RETURNS INT AS '
DECLARE
v_id INT;
BEGIN
INSERT INTO admin(login, mot_de_passe)
VALUES (p_login, p_mot_de_passe)
    RETURNING id_admin INTO v_id;
RETURN v_id;
END;
'LANGUAGE 'plpgsql';