/** Trigger to delete corresponding advertised rides when driver is deleted**/
CREATE OR REPLACE FUNCTION del_driver_trg_func()
RETURNS TRIGGER
AS
$$
BEGIN
	IF EXISTS (
		SELECT * FROM rides r
		WHERE r.c_plate = OLD.c_plate
	) THEN
		DELETE FROM rides r
		WHERE r.c_plate = OLD.c_plate;
		RETURN OLD;
	
	ELSE
		RETURN OLD;
	
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