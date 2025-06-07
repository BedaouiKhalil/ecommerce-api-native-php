<?php 

include "../connect.php" ; 

$favoriteId = filterRequest("favoriteId") ;  

deleteData("favorites" , "id = $favoriteId"); 