USE f32ee;

-- Tested adding these tables to mySQL, they work weeee

CREATE TABLE users (
    UserID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    FullName CHAR(40),
    ProfileImage LONGBLOB,
    Username VARCHAR(20) NOT NULL,
    Email VARCHAR(40) NOT NULL,
    UserPassword VARCHAR(40) NOT NULL
);

CREATE TABLE products (
    ProductSKU VARCHAR(20) NOT NULL PRIMARY KEY,
    ProductName CHAR(40) NOT NULL,
    ProductImage LONGBLOB NOT NULL,
    ProductDescription VARCHAR(100) NOT NULL,
    Price INT UNSIGNED NOT NULL,
    ProductCategory VARCHAR(20) NOT NULL,
    Quantity INT UNSIGNED NOT NULL
);
 
CREATE TABLE orders (
    OrderID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ProductSKU VARCHAR(20) NOT NULL, 
    UserID INT UNSIGNED NOT NULL, 
    OrderQuantity INT UNSIGNED NOT NULL,
    OrderStatus VARCHAR(20) NOT NULL,
    FOREIGN KEY (ProductSKU) REFERENCES products(ProductSKU),
    FOREIGN KEY (UserID) REFERENCES users(UserID)
);

CREATE TABLE jobs (
    JobSubmissionID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserID INT UNSIGNED NOT NULL, 
    StartDate DATE NOT NULL,
    Experience VARCHAR(100) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES users(UserID)
);