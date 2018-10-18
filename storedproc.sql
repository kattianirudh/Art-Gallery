DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_count`(INOUT `custid` INT, INOUT `artid` INT, INOUT `newcount` INT)
    MODIFIES SQL DATA
    COMMENT 'updates or inserts into the purchases '
BEGIN
    DECLARE oldcount INT DEFAULT 0;
    declare updatecount INT;
SELECT 
    purchases.count
INTO oldcount FROM
    purchases
WHERE
    purchases.id = custid
        AND purchases.art_id = artid; IF oldcount = 0 THEN
INSERT INTO purchases(id,art_id,count)
VALUES(custid, artid, newcount); ELSE
SET
    updatecount = newcount + oldcount;
UPDATE purchases 
SET 
    purchases.count = updatecount
WHERE
    purchases.id = custid
        AND purchases.art_id = artid;
END IF;
END$$
DELIMITER ;


SET @p0=''; 
SET @p1=''; 
SET @p2=''; 
CALL `update_count`(@p0, @p1, @p2);