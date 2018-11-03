CREATE OR REPLACE FUNCTION get_admin_drivers_list()
RETURNS TABLE (
	c_plate VARCHAR(10),
    d_email VARCHAR(64),
    c_brand VARCHAR(64),
    c_model VARCHAR(64)
)
AS 
$$
BEGIN
	RETURN QUERY SELECT d.c_plate, d.d_email, d.c_brand, d.c_model
	FROM drivers d;
END
$$
LANGUAGE plpgsql;