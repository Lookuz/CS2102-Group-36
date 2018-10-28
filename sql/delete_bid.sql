CREATE OR REPLACE FUNCTION delete_bid
(r_id_arg INT, u_email TEXT)
RETURNS void
AS
$$
BEGIN
DELETE FROM bids b
	WHERE b.r_id = r_id_arg AND
	b.p_email LIKE u_email;
END
$$
LANGUAGE plpgsql;