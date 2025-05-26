CREATE OR REPLACE VIEW itemview AS
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