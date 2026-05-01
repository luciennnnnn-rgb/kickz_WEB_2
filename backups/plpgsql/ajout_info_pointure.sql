CREATE OR REPLACE FUNCTION ajout_info_pointure(
    p_pointure     INT,
    p_stock        INT,
    p_id_chaussure INT
) RETURNS INT AS '
DECLARE
    v_id INT;
BEGIN
    INSERT INTO info_pointure(pointure, stock, id_chaussure)
    VALUES (p_pointure, p_stock, p_id_chaussure)
    RETURNING id_info_pointure INTO v_id;
    RETURN v_id;
END;
' LANGUAGE 'plpgsql';