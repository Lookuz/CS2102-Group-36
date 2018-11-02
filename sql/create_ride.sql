CREATE OR REPLACE FUNCTION create_ride
(c_plate TEXT, r_date_str TEXT, r_time_str TEXT, r_origin TEXT, r_destination TEXT)
RETURNS void
AS
$$
DECLARE
	r_date DATE;
	r_time TIME;
BEGIN
	r_date = string_to_date(r_date_str);
	r_time = string_to_time(r_time_str);

	INSERT INTO rides
	VALUES(c_plate, r_date, r_time, r_origin, r_destination);
END
$$
LANGUAGE plpgsql;