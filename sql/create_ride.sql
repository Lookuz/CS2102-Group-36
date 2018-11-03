CREATE OR REPLACE FUNCTION create_ride
(c_plate_arg TEXT, r_date_str TEXT, r_time_str TEXT, r_origin_arg TEXT, r_destination_arg TEXT)
RETURNS void
AS
$$
DECLARE
	r_date_arg DATE;
	r_time_arg TIME;
BEGIN
	r_date_arg = string_to_date(r_date_str);
	r_time_arg = string_to_time(r_time_str);

	INSERT INTO rides
	VALUES(DEFAULT, c_plate, r_date, r_time, r_origin, r_destination);
END
$$
LANGUAGE plpgsql;