CREATE OR REPLACE FUNCTION check_ride_status()
RETURNS void
AS
$$
BEGIN
	IF EXISTS (
		SELECT * 
		FROM rides r
		WHERE r.r_date < current_date OR
			  (r.r_date = current_date AND 
			  r.r_time <= current_time) 
	) THEN
		UPDATE rides
		SET a_status = 'CANCELLED'
		WHERE r_date < current_date OR
			  (r_date = current_date AND 
			  r_time <= current_time);
	END IF;
END;
$$
LANGUAGE plpgsql