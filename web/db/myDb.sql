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
  email      VARCHAR(50) NOT NULL,
  password_  VARCHAR(50) NOT NULL
);

-- CREATE TABLE orders(
--   order_id SERIAL  NOT NULL PRIMARY KEY,
--   user_id  INTEGER NOT NULL REFERENCES Users(user_id)
-- );

CREATE TABLE items(
  item_id    SERIAL      NOT NULL PRIMARY KEY,
  item_name  VARCHAR(50) NOT NULL,
  quantity   INTEGER     NOT NULL,
  image_dir VARCHAR(50) NOT NULL,
  price      VARCHAR(20) NOT NULL
);

CREATE TABLE cart_item(
  cart_id   SERIAL      NOT NULL PRIMARY KEY,
  -- quantity  INTEGER     NOT NULL, -- Maybe add back later, but complicated for now
  item_id   INTEGER     NOT NULL REFERENCES  items(item_id)
);

CREATE TABLE user_to_cart(
  user_to_cart_id SERIAL  NOT NULL PRIMARY KEY,
  cart_id         INTEGER NOT NULL REFERENCES cart_item(cart_id),
  user_id         INTEGER NOT NULL REFERENCES users(user_id)
);

CREATE TABLE user_to_address(
  user_to_address_id SERIAL  NOT NULL PRIMARY KEY,
  user_id            INTEGER NOT NULL REFERENCES users(user_id),
  address_id         INTEGER NOT NULL REFERENCES address_(address_id) 
);