CREATE OR REPLACE FUNCTION get_admin(
    p_login        TEXT,
    p_mot_de_passe TEXT
) RETURNS TABLE(id_admin INT, login TEXT) AS '
BEGIN
RETURN QUERY
SELECT a.id_admin, a.login
FROM admin a
WHERE a.login = p_login AND a.mot_de_passe = p_mot_de_passe;
END;
 'LANGUAGE 'plpgsql';