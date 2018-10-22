CREATE OR REPLACE FUNCTION create_ride_func
(d_plate_arg TEXT, c_plate_arg TEXT, r_origin_arg TEXT, r_destination_arg TEXT, r_date_str TEXT, r_time_str TEXT)
RETURNS void 
AS
$$
DECLARE
	r_date_arg DATE;
	r_time_arg TIME;
BEGIN
	r_date_arg = to_date(r_date_str, 'YYYY-MM-DD');
	r_time_arg = to_timestamp(r_time_str, 'HH24:MI:SS')::TIME;
	
	INSERT INTO rides
	VALUES
	(d_plate_arg, c_plate_arg, r_date_arg, r_time_arg, r_origin_arg, r_destination_arg, 'AVAILABLE');

END
$$
LANGUAGE plpgsql;