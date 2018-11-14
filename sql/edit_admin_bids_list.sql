/** Function to update bids for administrator **/
CREATE OR REPLACE FUNCTION edit_admin_bids_list
(r_id_key INT, p_email_key TEXT, r_id_arg INT, p_email_arg TEXT, bid_arg NUMERIC)
RETURNS void
AS 
$$
BEGIN
	UPDATE bids
	SET r_id = r_id_arg,
	p_email = p_email_arg,
	bid = bid_arg
	WHERE r_id = r_id_key AND
	p_email LIKE p_email_key;
END
$$
LANGUAGE plpgsql;