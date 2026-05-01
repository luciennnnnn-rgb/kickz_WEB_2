CREATE OR REPLACE FUNCTION ajout_avis(
    p_commentaire  TEXT,
    p_id_client    INT,
    p_id_chaussure INT
) RETURNS INT AS'
DECLARE
    v_id INT;
BEGIN
    INSERT INTO avis(commentaire, id_client, id_chaussure)
    VALUES (p_commentaire, p_id_client, p_id_chaussure)
    RETURNING id_avis INTO v_id;
    RETURN v_id;
END;
' LANGUAGE 'plpgsql';