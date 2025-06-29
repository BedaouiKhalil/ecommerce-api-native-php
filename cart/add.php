<?php


include "../connect.php";


$userId = filterRequest("userId") ; 
$itemId = filterRequest("itemId") ; 


$count  = getData("carts", "item_id = $itemId AND user_id = $userId" ,null  , false );


$data = array(
    "user_id" =>  $userId,
    "item_id" =>  $itemId
);

insertData("carts", $data);
