CREATE OR REPLACE FUNCTION update_stock(
    p_id_info_pointure INT,
    p_stock            INT
) RETURNS VOID AS '
BEGIN
UPDATE info_pointure SET stock = p_stock
WHERE id_info_pointure = p_id_info_pointure;
END;
'LANGUAGE 'plpgsql';