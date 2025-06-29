<?php 

include "../connect.php" ; 

$userId = filterRequest("userId") ; 

getAllData("address" , "user_id = $userId ") ; 