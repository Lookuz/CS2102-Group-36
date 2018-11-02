CREATE OR REPLACE FUNCTION create_bid
(r_id INT, p_email TEXT, bid NUMERIC)
RETURNS void
AS
$$
BEGIN
	INSERT INTO bids
	VALUES(r_id, p_email, bid);
END
$$
LANGUAGE plpgsql;