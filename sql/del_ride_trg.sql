/** Trigger to delete corresponding bids when ride is deleted**/
CREATE OR REPLACE FUNCTION del_ride_trg_func()
RETURNS TRIGGER
AS
$$
BEGIN
	RAISE NOTICE 'Executing del_ride_trg_func()';
	IF EXISTS (
		SELECT * FROM bids b
		WHERE b.r_id = OLD.r_id
	) THEN
		DELETE FROM bids b
		WHERE OLD.r_id = b.r_id;
		RAISE NOTICE 'Deleting old entries with ride ID %', OLD.r_id;
	
		RETURN OLD;
	ELSE
		RAISE NOTICE 'No related entries, exiting';
		RETURN NULL;
	END IF;
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS del_ride_trg ON rides;
CREATE TRIGGER del_ride_trg
BEFORE DELETE
ON rides
FOR EACH ROW
EXECUTE PROCEDURE del_ride_trg_func();