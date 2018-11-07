CREATE OR REPLACE FUNCTION check_ride_datetime_trg()
RETURNS TRIGGER
AS
$$
BEGIN
	CASE
		WHEN NEW.r_date > current_date THEN
			RETURN NEW;
		WHEN NEW.r_date = current_date THEN
			IF NEW.r_time < current_time THEN
				RETURN NULL;
			ELSE
				RETURN NEW;
			END IF;
		WHEN NEW.r_date < current_date THEN
			RETURN NULL;
	END CASE;
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS check_ride_datetime ON rides;
CREATE TRIGGER check_ride_datetime
BEFORE INSERT
ON rides
FOR EACH ROW
EXECUTE PROCEDURE check_ride_datetime_trg();