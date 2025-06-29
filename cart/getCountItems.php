<?php 

 include "../connect.php" ; 

$userId = filterRequest("userId") ; 
$itemId = filterRequest("itemId") ; 

 $stmt = $con->prepare("SELECT COUNT(carts.id) as countItems  FROM `carts` WHERE user_id = $userId AND item_id  =  $itemId");
 $stmt->execute() ; 

 $count = $stmt->rowCount() ; 

 $data = $stmt->fetchColumn() ; 
 

  if ($count > 0 ){
    
    echo json_encode(array("status" => "success" , "data" => $data)) ; 

  } else {

    echo json_encode(array("status" => "success" , "data" => "0")) ; 

  }


?>