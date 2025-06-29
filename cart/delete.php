<?php 

include "../connect.php";

$userId = filterRequest("userId");
$itemId = filterRequest("itemId");

// Étape 1 : récupérer l'ID du panier correspondant
$stmt = $con->prepare("SELECT id FROM carts WHERE user_id = ? AND item_id = ? LIMIT 1");
$stmt->execute([$userId, $itemId]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $cartId = $row['id'];

    // Étape 2 : suppression avec ID trouvé
    deleteData("carts", "id = $cartId");

} else {
    echo json_encode(["status" => "failed", "message" => "Cart item not found"]);
}

