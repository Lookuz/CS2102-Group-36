CREATE OR REPLACE FUNCTION create_driver
(c_plate TEXT, d_email TEXT, c_brand TEXT, c_model TEXT)
RETURNS void
AS
$$
BEGIN
	INSERT INTO drivers
	VALUES(c_plate, d_email, c_brand, c_model);
END
$$
LANGUAGE plpgsql;