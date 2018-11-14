/** Function to update drivers for administrator **/
CREATE OR REPLACE FUNCTION edit_admin_drivers_list
(c_plate_key TEXT, c_plate_arg TEXT, d_email_arg TEXT, c_brand_arg TEXT, c_model_arg TEXT)
RETURNS void
AS
$$
BEGIN
	UPDATE drivers
	SET c_plate = c_plate_arg,
	d_email = d_email_arg,
	c_brand = c_brand_arg,
	c_model = c_model_arg
	WHERE c_plate LIKE c_plate_key;
END
$$
LANGUAGE plpgsql;