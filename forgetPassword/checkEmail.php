<?php
include "../connect.php";
$email = filterRequest("email");

$verfiyCode = rand(10000, 99999);

$stmt = $con->prepare("SELECT * FROM users WHERE email = ? ");
$stmt->execute(array($email));
$count = $stmt->rowCount();
result($count);

if ($count > 0) {
    $data = array("verify_code" => $verfiyCode);
    updateData("users", $data, "email = '$email'", false);
    sendEmail($email, "Verfiy Code Ecommerce", "Verfiy Code $verfiyCode");
}