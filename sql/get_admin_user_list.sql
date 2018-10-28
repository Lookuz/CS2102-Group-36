CREATE OR REPLACE FUNCTION get_admin_user_list()
RETURNS TABLE (
	u_email VARCHAR(64),
    u_name VARCHAR(64),
	u_password VARCHAR(64)
)
AS 
$$
BEGIN
	RETURN QUERY SELECT u.u_email, u.u_name, u.u_password
	FROM users u;
END
$$
LANGUAGE plpgsql;