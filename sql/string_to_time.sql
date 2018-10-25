CREATE OR REPLACE FUNCTION string_to_time
(time_str TEXT)
RETURNS TIME
AS
$$
DECLARE
    _result TIME;
BEGIN
    SELECT to_timestamp(time_str, 'HH24:MI:SS')::TIME
    INTO _result;

    RETURN _result;
END;
$$
LANGUAGE plpgsql