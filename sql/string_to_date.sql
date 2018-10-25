CREATE OR REPLACE FUNCTION string_to_date
(date_str TEXT)
RETURNS DATE
AS
$$
DECLARE 
	_result DATE;
BEGIN
    SELECT to_date(date_str, 'YYYY-MM-DD')
	INTO _result;
	
	RETURN _result;
END;
$$
LANGUAGE plpgsql