CREATE OR REPLACE FUNCTION accept_a_bid
(r_id_arg INT, p_email_arg TEXT)
RETURNS void
AS
$$
BEGIN
	UPDATE rides
	SET a_status = 'TAKEN'
	WHERE r_id = r_id_arg;

	UPDATE bids
	SET b_status =  CASE
		WHEN p_email = p_email_arg THEN 'ACCEPTED'
		ELSE 'REJECTED'
		END
	WHERE r_id = r_id_arg;
END
$$
LANGUAGE plpgsql;
