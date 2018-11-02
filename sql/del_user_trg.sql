/** Trigger to delete corresponding bids, and driver entry when user is deleted**/
CREATE OR REPLACE FUNCTION del_user_trg_func()
RETURNS TRIGGER
AS
$$
BEGIN
	RAISE NOTICE 'Executing del_user_trg_func()';
	CASE
		WHEN EXISTS (
			SELECT * FROM bids b
			WHERE b.p_email = OLD.u_email
		) THEN
			DELETE FROM bids b
			WHERE b.p_email = OLD.u_email;
			RAISE NOTICE 'Deleting old bid entries with u_email %', OLD.u_email;

		WHEN EXISTS (
			SELECT * FROM drivers d
			WHERE d.d_email = OLD.u_email
		) THEN
			DELETE FROM drivers d
			WHERE d.d_email = OLD.u_email;
			RAISE NOTICE 'Deleting old driver entries with u_email %', OLD.u_email;

		ELSE
			RAISE NOTICE 'No related entries, exiting';
			RETURN NULL;
	END CASE;
		
	RETURN OLD;
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS del_user_trg ON users;
CREATE TRIGGER del_user_trg
BEFORE DELETE
ON users
FOR EACH ROW
EXECUTE PROCEDURE del_user_trg_func();