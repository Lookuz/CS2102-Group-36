CREATE OR REPLACE FUNCTION get_admin_rides_list()
RETURNS TABLE (
	r_id INT,
    c_plate VARCHAR(10),
    r_date DATE,
    r_time TIME,
    r_origin VARCHAR(64),
    r_destination VARCHAR(64),
    a_status VARCHAR(10)
)
AS 
$$
BEGIN
	RETURN QUERY SELECT *
	FROM rides r;
END
$$
LANGUAGE plpgsql;