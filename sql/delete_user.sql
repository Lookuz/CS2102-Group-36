/** Function to delete user **/
CREATE OR REPLACE FUNCTION delete_user
(u_email_arg TEXT)
RETURNS void
AS
$$
BEGIN
DELETE FROM users u
	WHERE u.u_email LIKE u_email_arg;
END
$$
LANGUAGE plpgsql;