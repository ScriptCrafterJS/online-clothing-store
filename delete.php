<?php
//include your database connection file
require_once('dpconfig.in.php');

$pdo = db_connect();
// Sanitize the product_id
if (isset($_GET['product_id'])) {

    $productId = $_GET['product_id'];
    
    $stmt = $pdo->prepare("DELETE FROM clothes WHERE product_id = :product_id");
    $stmt->bindParam(':product_id', $productId);
    $stmt->execute();
}

//redirect back to the table display page
header('Location: products.php');
exit;
?>