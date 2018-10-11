CREATE OR REPLACE FUNCTION user_bid_func
(r_origin_arg TEXT, r_destination_arg TEXT, r_date_str TEXT, r_time_str TEXT, p_email_arg TEXT, new_bid NUMERIC)
RETURNS void
AS
$$
DECLARE 
	r_date_arg DATE;
	r_time_arg TIME;
BEGIN
	r_date_arg = to_date(r_date_str, 'YYYY-MM-DD');
	r_time_arg = to_timestamp(r_time_str, 'HH24:MI:SS')::TIME;
	
	IF EXISTS (
		SELECT *
		FROM bids b INNER JOIN rides r
		ON b.d_email = r.d_email AND
		b.c_plate = r.c_plate AND
		b.r_date = r.r_date AND
		b.r_time = r.r_time 
		WHERE (r.r_origin, r.r_destination, r.r_date, r.r_time) = (r_origin_arg, r_destination_arg, r_date_arg , r_time_arg) AND
		b.p_email = p_email_arg) THEN
		
		UPDATE bids b
		SET bid = new_bid 
		FROM rides r
		WHERE b.d_email = r.d_email AND
		b.c_plate = r.c_plate AND
		b.r_date = r.r_date AND
		b.r_time = r.r_time AND
		(r.r_origin, r.r_destination, r.r_date, r.r_time) = (r_origin_arg, r_destination_arg, r_date_arg , r_time_arg) AND
		b.p_email = p_email_arg;

	ELSE
		INSERT INTO bids(d_email, c_plate, r_date, r_time, p_email, bid)
		SELECT r.d_email, r.c_plate, r.r_date, r.r_time, p_email_arg, new_bid
		FROM rides r
		WHERE (r.r_origin, r.r_destination, r.r_date, r.r_time) = (r_origin_arg, r_destination_arg, r_date_arg , r_time_arg);
		
	END IF;
END;
$$
LANGUAGE plpgsql