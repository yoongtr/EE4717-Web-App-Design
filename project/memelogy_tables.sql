USE f32ee;

-- Tested adding these tables to mySQL, they work weeee

CREATE TABLE users (
    UserID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    FirstName CHAR(40),
    LastName CHAR(40),
    Username VARCHAR(20) NOT NULL,
    Email VARCHAR(40) NOT NULL,
    UserPassword VARCHAR(40) NOT NULL
);

CREATE TABLE products (
    ProductSKU VARCHAR(20) NOT NULL PRIMARY KEY,
    ProductName VARCHAR(40) NOT NULL,
    ProductImage LONGBLOB,
    ProductDescription VARCHAR(100) NOT NULL,
    Price FLOAT(4,2) NOT NULL,
    ProductCategory VARCHAR(20) NOT NULL,
    Trending BOOLEAN NOT NULL,
    Sale BOOLEAN NOT NULL,
    SpecialCollection BOOLEAN NOT NULL,
    Quantity INT UNSIGNED NOT NULL
);
 
CREATE TABLE orders (
    OrderID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    OrderDate DATE,
    ProductSKU VARCHAR(20) NOT NULL, 
    UserID INT UNSIGNED NOT NULL, 
    OrderQuantity INT UNSIGNED NOT NULL,
    FOREIGN KEY (ProductSKU) REFERENCES products(ProductSKU),
    FOREIGN KEY (UserID) REFERENCES users(UserID)
);

CREATE TABLE memologyIt (
    SubmissionID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserID INT UNSIGNED NOT NULL, 
    ItemName VARCHAR(40) NOT NULL,
    Colour VARCHAR(100) NOT NULL,
    ImageUploaded LONGBLOB NOT NULL,
    DeliveryAddress VARCHAR(200) NOT NULL,
    Comments VARCHAR(200) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES users(UserID)
);

CREATE TABLE subscribe (
    SubID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    SubEmail VARCHAR(40) NOT NULL
);