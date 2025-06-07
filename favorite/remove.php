<?php 

include "../connect.php" ; 

$userId = filterRequest("userId") ; 
$itemId = filterRequest("itemId") ; 

deleteData("favorites" , "user_id = $userId AND item_id = $itemId") ; 