<?php

require_once('dpconfig.in.php');
include_once('Product.php');

$pdo = db_connect();

//to check if the product id is in the query string
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    
    $sql = $pdo->prepare("SELECT * FROM clothes WHERE product_id = :product_id");
    $sql->bindParam(':product_id', $productId);
    $sql->execute();
    $product = $sql->fetchObject('Product');
} else {
    $product = null;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>

<body>
    <?php displayHead()?>
    <main>
        <?php
            if ($product) {
                echo $product->displayProductPage();
            }
            echo displayFooter();
        ?>
    </main>
</body>

</html>