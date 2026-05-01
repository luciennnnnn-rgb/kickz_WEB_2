CREATE OR REPLACE FUNCTION effacer_chaussure(
    p_id_chaussure INT
) RETURNS VOID AS '
BEGIN
DELETE FROM chaussure WHERE id_chaussure = p_id_chaussure;
END;
'LANGUAGE 'plpgsql';