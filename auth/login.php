<?php

include "../connect.php";
 
$password = sha1($_POST['password']);
$email = filterRequest("email"); 

getData("users" , "email = ? AND  password = ? AND approve = 1 " , array($email , $password)) ; 