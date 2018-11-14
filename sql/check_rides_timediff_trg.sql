/** Trigger to ensure that rides advertised by a driver are more than 15 minutes apart**/
CREATE OR REPLACE FUNCTION check_rides_timediff_trg()
RETURNS TRIGGER
AS
$$
BEGIN
	IF EXISTS (
		SELECT * 
		FROM rides r
		WHERE NEW.c_plate = r.c_plate AND
		r.a_status LIKE 'AVAILABLE' AND
		NEW.r_date = r.r_date AND
		(
			get_absinterval(NEW.r_time, r.r_time) < INTERVAL'15 minutes'
		) 
	) THEN
		RAISE EXCEPTION 'ERROR: RIDE CANNOT BE 15 MINUTES FROM PREVIOUSLY ADVERTISED RIDES';
		RETURN NULL;
		
	END IF;
	
	RETURN NEW;
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS check_rides_timediff ON rides;
CREATE TRIGGER check_rides_timediff
BEFORE INSERT
ON rides
FOR EACH ROW
EXECUTE PROCEDURE check_rides_timediff_trg();
