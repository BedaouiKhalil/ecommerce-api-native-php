<?php


include "../connect.php";


$userId = filterRequest("userId");

getAllData("my_favorites_view", "favorite_user_id = ?  ", array($userId));