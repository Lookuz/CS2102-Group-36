/** Function to retrieve all bids for administrator **/
CREATE OR REPLACE FUNCTION get_admin_bids_list()
RETURNS TABLE (
	r_id INT,
    p_email VARCHAR(64),
    bid NUMERIC
)
AS 
$$
BEGIN
	RETURN QUERY SELECT b.r_id, b.p_email, b.bid
	FROM bids b;
END
$$
LANGUAGE plpgsql;