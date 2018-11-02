/** Trigger to delete corresponding advertised rides when driver is deleted**/
CREATE OR REPLACE FUNCTION del_driver_trg_func()
RETURNS TRIGGER
AS
$$
BEGIN
	RAISE NOTICE 'Executing del_driver_trg_func()';
	IF EXISTS (
		SELECT * FROM rides r
		WHERE r.c_plate = OLD.c_plate
	) THEN
		DELETE FROM rides r
		WHERE r.c_plate = OLD.c_plate;
		RAISE NOTICE 'Deleting old ride entries with d_email %', OLD.d_email;
		RETURN OLD;
	
	ELSE
		RAISE NOTICE 'No relevant entries, exiting';
		RETURN NULL;
	
	END IF;
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS del_driver_trg ON drivers;
CREATE TRIGGER del_driver_trg
BEFORE DELETE
ON drivers
FOR EACH ROW
EXECUTE PROCEDURE del_driver_trg_func();