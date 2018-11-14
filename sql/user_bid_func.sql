/** Function creates a new bid for ride with r_id, else updates existing bid **/
CREATE OR REPLACE FUNCTION user_bid_func
(p_email_arg TEXT, r_id_arg INT, new_bid NUMERIC)
RETURNS void
AS
$$
BEGIN
	
	IF EXISTS (
		SELECT * 
		FROM bids b
		WHERE b.p_email = p_email_arg AND
		b.r_id = r_id_arg
		) THEN
		
		UPDATE bids b
		SET bid = new_bid 
		WHERE b.p_email = p_email_arg AND
		b.r_id = r_id_arg; 

	ELSE
		INSERT INTO bids
		VALUES (r_id_arg, p_email_arg, new_bid);
		
	END IF;
END;
$$
LANGUAGE plpgsql;