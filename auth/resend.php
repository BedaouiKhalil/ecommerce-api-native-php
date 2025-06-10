<?php 

include "../connect.php"  ;

$email = filterRequest("email");

$verfiycode = rand(10000 , 99999);

$data = array(
"verify_code" => $verfiycode
) ; 

updateData("users" ,  $data  , "email = '$email'" ) ; 

sendEmail($email , "Verfiy Code Ecommerce" , "Verfiy Code $verfiycode") ; 

 