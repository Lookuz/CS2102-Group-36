CREATE OR REPLACE FUNCTION get_ride_details
(r_id_arg INT)
RETURNS TABLE (
	r_date_res DATE,
	r_time_res TIME,
	r_origin_res VARCHAR(64),
	r_destination_res VARCHAR(64)
)
AS
$$
BEGIN
	RETURN QUERY (
		SELECT DISTINCT r.r_date, r.r_time, r.r_origin, r.r_destination
		FROM rides r
		WHERE  r.r_id = r_id_arg
	);
END
$$
LANGUAGE plpgsql;