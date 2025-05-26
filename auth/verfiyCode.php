<?php 

include "../connect.php" ;

$email  = filterRequest("email") ; 

$verfiy = filterRequest("verifyCode") ; 


$stmt = $con->prepare("SELECT * FROM users WHERE email = '$email' AND verify_code = '$verfiy' ") ; 
 
$stmt->execute() ; 

$count = $stmt->rowCount() ; 

if ($count > 0) {
 
    $data = array("approve" => "1") ; 

    updateData("users" , $data , "email = '$email'");

}else {
 printFailure("verifycode not Correct") ; 

}
?>