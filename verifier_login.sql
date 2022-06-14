
DROP FUNCTION IF EXISTS login_existe ;
DELIMITER //
CREATE FUNCTION login_existe (newfirstName VARCHAR(30), newlastName VARCHAR(30) )
 RETURNS INT
BEGIN
 /*declare result int;*/
    SELECT count(*) FROM users WHERE firstName = newfirstName AND lastName=newlastName INTO @result;
    RETURN @result;
END//
DELIMITER ;
 
SELECT login_existe();
_______________________________________________________
/*Le trigger qui annule l''insertion si le login est déjà dans la table user :*/

  


DROP TRIGGER IF EXISTS valide_insertion;
DELIMITER //
CREATE TRIGGER valide_insertion 
BEFORE INSERT ON users -   
FOR EACH ROW
BEGIN
    IF login_existe(NEW.firstName, NEW.lastName) 
    THEN
        signal sqlstate'45000'
        set message_text='impossible';   
    END IF;
END //
DELIMITER ;
mysql> insert into user values(null,'chouaki','iris');
ERROR 1644 (45000): impossible