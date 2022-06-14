CREATE VIEW VHABIT_DISPO as 
SELECT * FROM HABITATION 
WHERE habitation.numH NOT IN 
(select numH from reservation) 
UNION
 select * FROM HABITATION 
 WHERE numH IN (select numH FROM reservation 
                WHERE DateF<=curdate());
