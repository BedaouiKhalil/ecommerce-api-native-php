<?php 

include "../connect.php" ;

$email  = filterRequest("email") ; 

$verfiy = filterRequest("verifyCode") ; 



$stmt = $con->prepare("SELECT * FROM users WHERE email = '$email' AND verify_code = '$verfiy' ") ; 
 
$stmt->execute() ; 

$count = $stmt->rowCount() ; 

 result($count) ;