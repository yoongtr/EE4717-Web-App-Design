USE f32ee;

CREATE TABLE users (
    UserID INT UNSIGNED NOT NULL PRIMARY KEY,
    FullName VARCHAR NOT NULL,
    ProfileImage LONGBLOB NOT NULL,
    Username VARCHAR NOT NULL,
    Email VARCHAR NOT NULL,
    UserPassword VARCHAR NOT NULL
);

CREATE TABLE products (
    ProductSKU VARCHAR NOT NULL PRIMARY KEY,
    ProductName INT UNSIGNED NOT NULL,
    ProductImage LONGBLOB NOT NULL,
    ProductDescription VARCHAR NOT NULL,
    Price INT UNSIGNED NOT NULL,
    ProductCategory VARCHAR NOT NULL,
    Quantity INT UNSIGNED NOT NULL
);

CREATE TABLE orders (
    OrderID INT UNSIGNED NOT NULL PRIMARY KEY,
    ProductSKU VARCHAR NOT NULL FOREIGN KEY REFERENCES products(ProductSKU),
    UserID INT UNSIGNED NOT NULL FOREIGN KEY REFERENCES users(UserID),
    OrderQuantity INT UNSIGNED NOT NULL,
    OrderStatus VARCHAR,
);

CREATE TABLE jobs (
    JobSubmissionID INT UNSIGNED NOT NULL PRIMARY KEY,
    UserID INT UNSIGNED NOT NULL FOREIGN KEY REFERENCES users(UserID),
    StartDate DATE NOT NULL,
    Experience VARCHAR NOT NULL
);