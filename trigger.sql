/*** Trigger 1: dateD < dateF ***/

drop trigger if exists verify_date;
delimiter |
Create trigger verify_date
    BEFORE insert on reservation
    for each row
BEGIN
    if new.DateD > new.DateF
    then signal sqlstate '45000'
    set message_text=' erreur la date de debut doit etre inferieur a la date de fin';
    end  if;

END |
        
delimiter ;


/****** Trigger 2: dateD <= curdate ********/
drop trigger if exists verify_curdate;

DELIMITER | 
CREATE TRIGGER verify_curdate BEFORE
INSERT
  ON reservation FOR EACH ROW 
  BEGIN 
      IF new.DateD < curdate() 
      
      THEN
      /*SET new.DateD= curdate(); */
        signal sqlstate '45000'
        set message_text=' La date de debut doit etre superieure ou egale a la date courante ';
      END IF;
END | 
DELIMITER ;


/* Trigger 3 ***/

 
DELIMITER | 
    CREATE TRIGGER delete_client After DELETE ON client FOR EACH ROW 
BEGIN
    DELETE FROM
      reservation
    WHERE
      reservation.idClient = old.idClient;
END | 
DELIMITER ;
