<?php

include "../connect.php";

$categoryId = filterRequest("categoryId");
$userid = filterRequest("userId");

$stmt = $con->prepare("SELECT items_view.* , 1 as favorite FROM items_view 
INNER JOIN favorites ON favorites.item_id = items_view.item_id AND favorites.user_id = $userid
WHERE category_id = $categoryId
UNION ALL 
SELECT *  , 0 as favorite  FROM items_view
WHERE  category_id = $categoryId AND item_id NOT IN  ( SELECT items_view.item_id FROM items_view 
INNER JOIN favorites ON favorites.item_id = items_view.item_id AND favorites.user_id =  $userid  )");

$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count  = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}