/**Trigger to update the relevant bids when status of ride is changed/updated**/
CREATE OR REPLACE FUNCTION update_bid_status_trg()
RETURNS TRIGGER
AS
$$
BEGIN
	IF (
		NEW.a_status LIKE 'CANCELLED'
	) THEN
		UPDATE bids
		SET b_status = 'REJECTED'
		WHERE r_id = NEW.r_id;
	END IF;
	
	RETURN NEW;
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_bid_status ON rides;
CREATE TRIGGER update_bid_status
AFTER UPDATE
ON rides
FOR EACH ROW
EXECUTE PROCEDURE update_bid_status_trg();