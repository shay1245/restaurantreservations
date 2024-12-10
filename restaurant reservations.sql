
CREATE DATABASE restaurant_reservations;
USE restaurant_reservations;


CREATE TABLE Customers (
    customerId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerName VARCHAR(45) NOT NULL,
    contactInfo VARCHAR(200),
    PRIMARY KEY (customerId)
);


CREATE TABLE Reservations (
    reservationId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerId INT NOT NULL,
    reservationTime DATETIME NOT NULL,
    numberOfGuests INT NOT NULL,
    specialRequests VARCHAR(200),
    PRIMARY KEY (reservationId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
);


CREATE TABLE DiningPreferences (
    preferenceId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerId INT NOT NULL,
    favoriteTable VARCHAR(45),
    dietaryRestrictions VARCHAR(200),
    PRIMARY KEY (preferenceId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
);


INSERT INTO Customers (customerName, contactInfo)
VALUES
    ('John Doe', 'johndoe@example.com'),
    ('Jane Smith', 'janesmith@example.com'),
    ('Mike Johnson', 'mikejohnson@example.com');


INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
VALUES
    (1, '2024-12-10 19:00:00', 2, 'Window seat'),
    (2, '2024-12-11 20:00:00', 4, 'Birthday setup'),
    (3, '2024-12-12 18:30:00', 1, 'Vegetarian menu');


INSERT INTO DiningPreferences (customerId, favoriteTable, dietaryRestrictions)
VALUES
    (1, 'Table 5', 'Gluten-free'),
    (2, 'Table 10', 'Vegan'),
    (3, 'Table 3', 'Nut allergy');


SELECT * FROM Customers;
SELECT * FROM Reservations;
SELECT * FROM DiningPreferences;
