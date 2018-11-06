CREATE OR REPLACE FUNCTION unregister_as_driver
(d_email_arg TEXT)
RETURNS void
AS
$$
BEGIN
DELETE FROM drivers d
	WHERE d.d_email LIKE d_email_arg;
END
$$
LANGUAGE plpgsql;
