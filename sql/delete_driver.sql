CREATE OR REPLACE FUNCTION delete_driver
(c_plate_arg TEXT)
RETURNS void
AS
$$
BEGIN
DELETE FROM drivers d
	WHERE d.c_plate LIKE c_plate_arg;
END
$$
LANGUAGE plpgsql;