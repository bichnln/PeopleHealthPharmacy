DROP TABLE Supplier_Inventory;
DROP TABLE Sales_Record;
DROP TABLE Supplier;
DROP TABLE Inventory_Record;
DROP TABLE Employee;

CREATE TABLE Employee (
	eID varchar(30) NOT NULL,
	eName varchar(40) NOT NULL,
	eRole varchar(30) NOT NULL,
	ePassword varchar(40) NOT NULL,
	PRIMARY KEY (eID)
);

CREATE TABLE Inventory_Record(
	itemID int(10) NOT NULL AUTO_INCREMENT,
	itemName varchar(40) NOT NULL,
	itemPrice decimal(5,2) NOT NULL,
	itemStock int(10),
	category varchar(30),
	PRIMARY KEY(itemID)
);

CREATE TABLE Sales_Record(
	eID varchar(30) NOT NULL,
	itemID int(10) NOT NULL AUTO_INCREMENT,
	salesDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	qty int(10),
	PRIMARY KEY(eID, itemID, salesDate),
	FOREIGN KEY (itemID) REFERENCES Inventory_Record(itemID)
);

CREATE TABLE Supplier(
	supID varchar(30) NOT NULL,
	supName varchar(40) NOT NULL,
	phoneNo varchar(15) NOT NULL,
	address varchar(40) NOT NULL,
	PRIMARY KEY(supID)
);

CREATE TABLE Supplier_Inventory(
	itemID int(10) NOT NULl AUTO_INCREMENT,
	supID varchar(30) NOT NULL,
	supDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(itemID, supID, supDate),
	FOREIGN KEY (itemID) REFERENCES Inventory_Record(itemID),
	FOREIGN KEY (supID) REFERENCES Supplier(supID)
);