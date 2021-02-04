-- CREATE TABLE address_(
--   address_id SERIAL     NOT NULL PRIMARY KEY,
--   street    VARCHAR(50) NOT NULL,
--   city      VARCHAR(50) NOT NULL,
--   state_    VARCHAR(50) NOT NULL,
--   country   VARCHAR(50) NOT NULL,
--   zip       INTEGER     NOT NULL,
--   billing   BOOLEAN     NOT NULL,
--   shipping  BOOLEAN     NOT NULL,
-- );

-- CREATE TABLE users(
--   user_id    SERIAL      NOT NULL PRIMARY KEY,
--   username   VARCHAR(50) NOT NULL,
--   email      VARCHAR(50) NOT NULL,
--   password_  VARCHAR(50) NOT NULL
-- );

-- CREATE TABLE user_to_address(
--   user_to_address_id SERIAL  NOT NULL PRIMARY KEY,
--   user_id            INTEGER NOT NULL REFERENCES users(user_id),
--   address_id         INTEGER NOT NULL REFERENCES address_(address_id) 
-- );

-- CREATE TABLE items(
--   item_id    SERIAL      NOT NULL PRIMARY KEY,
--   item_name  VARCHAR(50) NOT NULL,
--   quantity   INTEGER     NOT NULL,
--   image_dir VARCHAR(50) NOT NULL,
--   price      VARCHAR(20) NOT NULL
-- );
INSERT INTO address_ (street, city, state_, country, zip, billing, shipping) VALUES ('900 125th St', 'Puyallup', 'WA', 'US', 98373, 't', 't');
INSERT INTO users (username, email, password_) VALUES ('admin', 'admin99@gmail.com', 'pass');
INSERT INTO user_to_address(user_id, address_id) VALUES (1, 1);
INSERT INTO items(item_name, quantity, image_dir, price) VALUES ('Anduril', 50, '../imgs/Anduril.jpeg', 499);
INSERT INTO items(item_name, quantity, image_dir, price) VALUES ('Glamdring', 50, '../imgs/Glamdring.png', 399);
INSERT INTO items(item_name, quantity, image_dir, price) VALUES ('Sting', 50, '../imgs/Sting.png', 199);
INSERT INTO items(item_name, quantity, image_dir, price) VALUES ('Lego Gandalf', 50, '../imgs/lego-gandalf.png', 5);
INSERT INTO items(item_name, quantity, image_dir, price) VALUES ('Orc Armor', 50, '../imgs/orc-armor.png', 599);