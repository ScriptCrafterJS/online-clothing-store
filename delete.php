<?php
//include your database connection file
require_once('dpconfig.in.php');
include_once('Product.php');

$pdo = db_connect();
// Sanitize the product_id
if (isset($_GET['product_id'])) {

    $productId = $_GET['product_id'];
    
    $sql = $pdo->prepare("SELECT * FROM clothes WHERE product_id = :product_id");
    $sql->bindParam(':product_id', $productId);
    $sql->execute();
    $product = $sql->fetchObject('Product');

    $imagePath = $product->getImageURL();
    if ($product->getCategory() === 'Boots') {
        $imagePath = 'images/boots/'.$product->getImageURL();
    } elseif ($product->getCategory() === 'Shirts') {
        $imagePath = 'images/shirts/'.$product->getImageURL();
    } elseif ($product->getCategory() === 'Leggings') {
        $imagePath = 'images/leggings/'.$product->getImageURL();
    }

    if (file_exists($imagePath)) {
        if (unlink($imagePath)) {
            echo 'Image deleted successfully.';
        } else {
            echo 'Failed to delete image.';
        }
    } else {
        echo 'Image does not exist.';
    }
    
    $stmt = $pdo->prepare("DELETE FROM clothes WHERE product_id = :product_id");
    $stmt->bindParam(':product_id', $productId);
    $stmt->execute();
}

//redirect back to the table display page
header('Location: products.php');
exit;
?>