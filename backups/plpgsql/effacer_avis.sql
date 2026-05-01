CREATE OR REPLACE FUNCTION effacer_avis(
    p_id_avis INT
) RETURNS VOID AS '
BEGIN
DELETE FROM avis WHERE id_avis = p_id_avis;
END;
'LANGUAGE 'plpgsql';