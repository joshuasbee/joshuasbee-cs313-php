CREATE TABLE address_(
  address_id SERIAL     NOT NULL PRIMARY KEY,
  street    VARCHAR(50) NOT NULL,
  city      VARCHAR(50) NOT NULL,
  state_    VARCHAR(50) NOT NULL,
  country   VARCHAR(50) NOT NULL,
  zip       INTEGER     NOT NULL,
  billing   BOOLEAN     NOT NULL,
  shipping  BOOLEAN     NOT NULL
);

CREATE TABLE users(
  user_id    SERIAL      NOT NULL PRIMARY KEY,
  --username   VARCHAR(50) NOT NULL,
  email      VARCHAR(50) NOT NULL,
  password_  VARCHAR(50) NOT NULL
);

CREATE TABLE orders(
  order_id SERIAL  NOT NULL PRIMARY KEY,
  user_id  INTEGER NOT NULL REFERENCES Users(user_id)
);

CREATE TABLE items(
  item_id    SERIAL      NOT NULL PRIMARY KEY,
  item_name  VARCHAR(50) NOT NULL,
  quantity   INTEGER     NOT NULL,
  image_dir VARCHAR(50) NOT NULL,
  price      VARCHAR(20) NOT NULL
);

CREATE TABLE cart(
  cart_id   SERIAL      NOT NULL PRIMARY KEY,
  quantity  INTEGER     NOT NULL,
  item_id   INTEGER     NOT NULL REFERENCES  items(item_id)
);

CREATE TABLE cart_to_user(
  cart_to_user_id SERIAL  NOT NULL PRIMARY KEY,
  cart_id         INTEGER NOT NULL REFERENCES cart(cart_id),
  order_id        INTEGER NOT NULL REFERENCES orders(order_id)
);

CREATE TABLE user_to_address(
  user_to_address_id SERIAL  NOT NULL PRIMARY KEY,
  user_id            INTEGER NOT NULL REFERENCES users(user_id),
  address_id         INTEGER NOT NULL REFERENCES address_(address_id) 
);