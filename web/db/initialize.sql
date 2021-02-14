INSERT INTO address_ (street, city, state_, country, zip, billing, shipping) VALUES ('900 125th St', 'Puyallup', 'WA', 'US', 98373, 't', 't');
--INSERT INTO users (email, password_) VALUES ('admin99@gmail.com', 'pass');
INSERT INTO users (email, password_) VALUES ('a', 'a');--remove later probably
INSERT INTO user_to_address(user_id, address_id) VALUES (1, 1);
--do all inventory here
INSERT INTO items(item_name, quantity, image_dir, price) VALUES ('anduril', 0, '../imgs/Anduril.jpeg', 499);
INSERT INTO items(item_name, quantity, image_dir, price) VALUES ('glamdring', 5, '../imgs/Glamdring.png', 399);
INSERT INTO items(item_name, quantity, image_dir, price) VALUES ('sting', 30, '../imgs/Sting.png', 199);
INSERT INTO items(item_name, quantity, image_dir, price) VALUES ('lego gandalf', 512, '../imgs/lego-gandalf.png', 5);
INSERT INTO items(item_name, quantity, image_dir, price) VALUES ('orc armor', 20, '../imgs/orc-armor.png', 599);
--have to create carts after items that are to be put in them
-- INSERT INTO cart_item(item_id) VALUES (3);
-- INSERT INTO user_to_cart(cart_id, user_id) VALUES (1, 1);