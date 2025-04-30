create database a;
use a;
CREATE TABLE tbl_admin(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    username VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    password VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
);
CREATE TABLE tbl_user(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    username VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    password VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
);

CREATE TABLE tbl_category(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   title VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    image_name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    feature VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     active VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
);
CREATE TABLE tbl_food(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   title VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   description VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    image_name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    feature VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     active VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
);

CREATE TABLE tbl_order(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
food VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
price DECIMAL(10, 2) NOT NULL,  -- Removed CHARACTER SET and COLLATE,
qty int(11) NOT NULL,  -- Removed CHARACTER SET and COLLATE
total DECIMAL(10, 2) NOT NULL,  -- Removed CHARACTER SET and COLLATE,
order_data datetime NOT NULL,  -- Removed CHARACTER SET and COLLATE
status VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
customer_name VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
customer_contact VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
customer_email VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
customer_address VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
);

