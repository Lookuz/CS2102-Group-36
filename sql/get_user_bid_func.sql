CREATE OR REPLACE FUNCTION get_user_bid_func
(u_email TEXT, r_id_arg INT)
RETURNS INT
AS
$$
DECLARE
	_result INT;
BEGIN

	SELECT b.bid
	FROM bids b 
	WHERE b.p_email = u_email AND
	b.r_id = r_id_arg
	INTO _result;
	
	RETURN _result;

END;
$$
LANGUAGE plpgsql