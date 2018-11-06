CREATE OR REPLACE FUNCTION signup_as_driver
(c_plate_arg TEXT, d_email_arg TEXT, c_brand_arg TEXT, c_model_arg TEXT)
RETURNS void
AS
$$
BEGIN
	INSERT INTO drivers
	VALUES(c_plate_arg, d_email_arg, c_brand_arg, c_model_arg);
END;
$$
LANGUAGE plpgsql;
