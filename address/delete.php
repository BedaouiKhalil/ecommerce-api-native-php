<?php 

include "../connect.php" ; 

$addressId = filterRequest("addressId"); 

deleteData("address" , "id  = $addressId"); 