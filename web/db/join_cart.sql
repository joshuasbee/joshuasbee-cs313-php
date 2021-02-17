SELECT items.item_name 
FROM user_to_cart
INNER JOIN cart_item 
  ON user_to_cart.cart_id = cart_item.cart_id
INNER JOIN items
  ON cart_item.item_id = items.item_id;