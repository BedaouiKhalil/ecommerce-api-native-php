<?php 

include '../connect.php';

$table = "address";

$addressId    = filterRequest("addressId"); 
$name       = filterRequest("name");
$city       = filterRequest("city");
$street     = filterRequest("street");

$data = array(  
"city" => $city,
"user_id" => $userId,
"name"   => $name,
"street" => $street,
);

updateData($table , $data , "id = $addressId");