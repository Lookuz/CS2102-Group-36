CREATE OR REPLACE FUNCTION get_absinterval
(time1 TIME, time2 TIME)
RETURNS INTERVAL
AS
$$
BEGIN
	RETURN GREATEST((time1 - time2), (time2 - time1));
END
$$
LANGUAGE plpgsql;