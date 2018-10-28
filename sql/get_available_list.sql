CREATE OR REPLACE FUNCTION get_available_list
(u_email TEXT)
RETURNS TABLE (
	r_date_res DATE,
	r_time_res TIME,
	r_origin_res VARCHAR(64),
	r_destination_res VARCHAR(64),
	max_bid NUMERIC
)
AS 
$$
BEGIN
DROP TABLE IF EXISTS all_bids;
CREATE TEMP TABLE all_bids AS (
	SELECT r.r_date, r.r_time, r.r_origin, r.r_destination, MAX(b.bid)
	FROM rides r LEFT OUTER JOIN bids b ON
	r.r_id = b.r_id
	GROUP BY r.r_id, r.r_date, r.r_time, r.r_origin, r.r_destination
	ORDER BY r.r_date, r.r_time
);

IF (u_email IS NULL) THEN
	RETURN QUERY (SELECT * FROM all_bids);
ELSE
	RETURN QUERY SELECT * FROM all_bids EXCEPT (
		SELECT r.r_date, r.r_time, r.r_origin, r.r_destination, MAX(b.bid)
		FROM rides r LEFT OUTER JOIN bids b ON
		r.r_id = b.r_id
		WHERE EXISTS(
			SELECT * 
			FROM drivers d INNER JOIN rides r2
			ON d.c_plate = r2.c_plate
			WHERE r2.r_id = r.r_id AND
			d.d_email = u_email)
		GROUP BY r.r_id, r.r_date, r.r_time, r.r_origin, r.r_destination);
END IF;
END
$$
LANGUAGE plpgsql;