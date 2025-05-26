<?php

include "../connect.php";

$username = filterRequest("username");
$password = sha1($_POST['password']);
$email = filterRequest("email");
$phone = filterRequest("phone");
$verfiyCode = rand(10000 , 99999);

$stmt = $con->prepare("SELECT * FROM users WHERE email = ? OR phone = ? ");
$stmt->execute(array($email, $phone));
$count = $stmt->rowCount();

if ($count > 0) {
    printFailure("EMAIL OR PHONE ALREADY EXISTS");
} else {

    $data = array(
        "username" => $username,
        "password" =>  $password,
        "email" => $email,
        "phone" => $phone,
        "verify_code" => $verfiyCode ,
    );

    $body = "<h1>Hello</h1><p>Here is your verification code: <strong>$verfiyCode</strong>.</p><p>Please use this code to complete your registration.</p>";
    
    sendEmail($email, "Your Verification Code", $body); 

    insertData("users", $data); 

}
