CREATE OR REPLACE FUNCTION delete_ride
(r_id_arg INT)
RETURNS void
AS
$$
BEGIN
DELETE FROM rides r
	WHERE r.r_id = r_id_arg;
END
$$
LANGUAGE plpgsql;