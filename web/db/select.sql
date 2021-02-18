select user_to_cart.cart_id 
  from user_to_cart, cart_item 
  where user_id = 1 
  
  and 
  
  cart_item.item_id = (
    select item_id 
      from items 
      where item_name = 'glamdring');

select item_id
  from items
  where item_name = 'glamdring';

select user_to_cart.user_id, cart_item.cart_id, cart_item.item_id
  from cart_item
  inner join user_to_cart on cart_item.cart_id = user_to_cart.cart_id
  where item_id = (
    select item_id
      from items
      where item_name = 'glamdring');