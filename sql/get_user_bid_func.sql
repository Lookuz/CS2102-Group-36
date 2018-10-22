CREATE OR REPLACE FUNCTION get_user_bid_func
(u_email TEXT, r_origin_arg TEXT, r_destination_arg TEXT, r_date_str TEXT, r_time_str TEXT)
RETURNS INT
AS
$$
DECLARE
	r_date_arg DATE;
	r_time_arg TIME;
	_result INT;
BEGIN
	r_date_arg = to_date(r_date_str, 'YYYY-MM-DD');
	r_time_arg = to_timestamp(r_time_str, 'HH24:MI:SS')::TIME;
	
	SELECT b.bid
	FROM bids b INNER JOIN rides r
	ON b.d_email = r.d_email AND
	b.c_plate = r.c_plate AND
	b.r_date = r.r_date AND
	b.r_time = r.r_time 
	WHERE (r.r_origin, r.r_destination, r.r_date, r.r_time) = (r_origin_arg, r_destination_arg, r_date_arg , r_time_arg) AND
	b.p_email = u_email
	INTO _result;
	
	RETURN _result;

END;
$$
LANGUAGE plpgsql