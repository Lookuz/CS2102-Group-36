CREATE OR REPLACE FUNCTION edit_admin_user_list
(users_key TEXT, u_email_arg TEXT, u_password_arg TEXT, u_name_arg TEXT, isAdmin_arg TEXT)
RETURNS void
AS 
$$
BEGIN
	UPDATE users
	SET u_email = u_email_arg,
	u_password = u_password_arg,
	u_name = u_name_arg,
	isAdmin = isAdmin_arg
	WHERE u_email LIKE users_key;
END
$$
LANGUAGE plpgsql;