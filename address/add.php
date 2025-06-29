<?php 

include '../connect.php';

$table = "address";

$userId    = filterRequest("userId");
$name       = filterRequest("name");
$city       = filterRequest("city");
$street     = filterRequest("street");

$data = array(  
"city" => $city,
"user_id" => $userId,
"name"   => $name,
"street" => $street,
);

insertData($table , $data);