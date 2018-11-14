/** Function for driver to advertise new ride **/
CREATE OR REPLACE FUNCTION offer_a_ride
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
	INSERT INTO rides(c_plate, r_date, r_time, r_origin,
		r_destination, a_status) VALUES(c_plate_arg, r_date_arg, r_time_arg,
		r_origin_arg, r_destination_arg, 'AVAILABLE');
END;
$$
LANGUAGE plpgsql;
