CREATE DATABASE Testing;

use Testing;

CREATE TABLE userlist (
    PersonID int,
    LastName varchar(255),
    FirstName varchar(255),
    Address varchar(255),
    City varchar(255) 
);

INSERT INTO userlist (PersonID, LastName, FirstName,  Address, City)
VALUES (0,'Schürmeyer','Felix','Muster','Item');
