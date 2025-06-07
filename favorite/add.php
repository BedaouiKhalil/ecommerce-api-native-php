<?php 

include "../connect.php" ; 


$userId = filterRequest("userId") ; 
$itemId = filterRequest("itemId") ; 


$data = array(
    "user_id"  =>   $userId , 
    "item_id"  =>   $itemId
);


insertData("favorites" ,$data) ; 