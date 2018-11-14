/** Function to update rides for administrator **/
CREATE OR REPLACE FUNCTION edit_admin_rides_list
(r_id_key INT, r_id_arg INT, c_plate_arg TEXT, r_date_str TEXT, r_time_str TEXT, 
 r_origin_arg TEXT, r_dest_arg TEXT, a_status_arg TEXT)
RETURNS void
AS 
$$
DECLARE 
	r_date_arg DATE;
	r_time_arg TIME;
BEGIN
	r_date_arg = string_to_date(r_date_str);
	r_time_arg = string_to_time(r_time_str);

	UPDATE rides
	SET r_id = r_id_arg,
	c_plate = c_plate_arg,
	r_date = r_date_arg,
	r_time = r_time_arg,
	r_origin = r_origin_arg,
	r_destination = r_dest_arg,
	a_status = a_status_arg
	WHERE r_id = r_id_key;
END
$$
LANGUAGE plpgsql;