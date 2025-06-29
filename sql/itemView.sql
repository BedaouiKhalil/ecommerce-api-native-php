CREATE OR REPLACE VIEW items_view AS
SELECT
items.id AS item_id,
items.name AS item_name,
items.name_ar AS item_name_ar,
items.price AS item_price,
items.image AS item_image,
items.date AS item_date,
items.count AS item_count,
items.discount AS item_discount,
items.active AS item_active,
items.name AS item_description,
items.name AS item_description_ar,
items.category_id AS item_category_id,

categories.id AS category_id,
categories.name AS category_name,
categories.name AS category_name_ar,
categories.image AS category_image,
categories.datetime AS category_datetime

FROM items
INNER JOIN categories ON categories.id = items.category_id;

-- favorite view -->
CREATE OR REPLACE VIEW my_favorites_view AS
SELECT 
favorites.id AS favorite_id,
favorites.user_id AS favorite_user_id,
favorites.item_id AS favorite_item_id,
items.id AS item_id,
items.name AS item_name,
items.name_ar AS item_name_ar,
items.price AS item_price,
items.image AS item_image,
items.date AS item_date,
items.count AS item_count,
items.discount AS item_discount,
items.active AS item_active,
items.name AS item_description,
items.name AS item_description_ar,
items.category_id AS item_category_id,
  users.id AS user_id
FROM favorites
INNER JOIN users ON users.id = favorites.user_id
INNER JOIN items ON items.id = favorites.item_id;



-- CREATE OR REPLACE VIEW carts_view as 
-- SELECT SUM(items.price) as cart_item_price, count(carts.item_id) as cart_item_count , items.id AS item_id,
-- items.name AS item_name,
-- items.name_ar AS item_name_ar,
-- items.price AS item_price,
-- items.image AS item_image,
-- items.date AS item_date,
-- items.discount AS item_discount,
-- items.active AS item_active,
-- items.name AS item_description,
-- items.name AS item_description_ar,
-- items.category_id AS item_category_id, carts.id AS cart_id, carts.item_id AS cart_item_id, carts.user_id as cart_user_id FROM carts
-- INNER JOIN items on items.id = carts.item_id
-- GROUP BY carts.item_id , carts.user_id;


CREATE OR REPLACE VIEW carts_view AS
SELECT
  carts.user_id AS user_id,
  carts.item_id AS item_id,
  items.name AS item_name,
  items.name_ar AS item_name_ar,
  items.price AS item_price,
  items.discount AS item_discount,
  items.name AS item_description,
  items.name_ar AS item_description_ar,
  items.image AS item_image,
  items.category_id AS item_category_id,
  COUNT(*) AS item_count_in_cart,
  SUM(items.price - ((items.price * items.discount) / 100)) AS item_price_in_cart
FROM carts
JOIN items ON items.id = carts.item_id
GROUP BY carts.user_id, carts.item_id, items.name, items.name_ar, items.price, items.image, items.category_id;
