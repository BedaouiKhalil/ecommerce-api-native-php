<?php

include "../connect.php";

$userId = filterRequest("userId");

$data  = getAllData("carts_view", "user_id = $userId", null, false);

$stmt = $con->prepare("SELECT SUM(item_price_in_cart) as totalPrice , count(item_price_in_cart) as totalCount  FROM `carts_view`  
WHERE  carts_view.user_id =  $userId 
GROUP BY carts_view.user_id  ");

$stmt->execute();


$dataCountPrice = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode(array(
    "status" => "success",
    "countPrice" =>  $dataCountPrice,
    "dataCart" => $data,
));