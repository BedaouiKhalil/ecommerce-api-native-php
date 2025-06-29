<?php 

include "../connect.php" ; 

$couponName = filterRequest("couponName") ; 

$now = date("Y-m-d H:i:s");

getData("coupons"  , "name = '$couponName' AND expire_date > '$now' AND count > 0  ")  ;




?>