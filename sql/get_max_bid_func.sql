CREATE OR REPLACE FUNCTION get_max_bid_func
(r_id_arg INT)
RETURNS INT 
AS
$$
DECLARE
	_result INT;
BEGIN

	SELECT MAX(b.bid)
	FROM bids b 
	WHERE b.r_id = r_id_arg
	INTO _result;
	
	RETURN _result;
END
$$
LANGUAGE plpgsql;