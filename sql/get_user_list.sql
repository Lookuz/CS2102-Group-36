/** Function to get all bids that the current user has made **/
CREATE OR REPLACE FUNCTION get_user_list
(u_email TEXT)
RETURNS TABLE (
	r_id INT,
	r_date_res DATE,
	r_time_res TIME,
	r_origin_res VARCHAR(64),
	r_destination_res VARCHAR(64),
	max_bid NUMERIC, 
	b_status VARCHAR(10)
)
AS 
$$
BEGIN
RETURN QUERY (SELECT r.r_id, r.r_date, r.r_time, r.r_origin, r.r_destination, MAX(b.bid), b.b_status
	FROM rides r INNER JOIN bids b ON
	r.r_id = b.r_id AND
	b.p_email = u_email 
	GROUP BY r.r_id, r.r_date, r.r_time, r.r_origin, r.r_destination, b.b_status
	ORDER BY r.r_date, r.r_time);
END
$$
LANGUAGE plpgsql;