<?php
    require_once('dpconfig.in.php');
    include_once('Product.php');
    
    $pdo = db_connect();
    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {//here when the user enter the page for the first time the suer info will be displayed
        if (isset($_GET['product_id'])) {
            $productId = $_GET['product_id'];
                
            $sql = $pdo->prepare("SELECT * FROM clothes WHERE product_id = :product_id");
            $sql->bindParam(':product_id', $productId);
            $sql->execute();
            $product = $sql->fetchObject('Product');
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {//if the user hit the update button then do the update script
        $product_Id = $_POST['productId'];
        $productName = $_POST['productName'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        
        //connect to the database
        $pdo = db_connect();
        
        //fetch the last added element
        $sql = $pdo->prepare("SELECT * FROM clothes WHERE product_id = :product_id");
        $sql->bindParam(':product_id', $product_Id);
        $sql->execute();
        $product = $sql->fetchObject('Product');
    
        
        //if theres a file upload (means the user decided to change the photo)
        if (isset($_FILES['productPhoto'])) {

            //move the uploaded file to the desired directory
            $photo = $_FILES['productPhoto'];
            $targetDir = "images/".$category."/";
            //basename() extracts the filename from the path of the uploaded file
            $imageName = basename($photo["name"]);
            
            //change the file name to be dedicated to its id
            $extension = pathinfo($imageName, PATHINFO_EXTENSION);//jpeg
            //rename the image file
            $newImageName = $product_Id . "." . $extension;
    
            $targetFile = $targetDir . $newImageName;
            //this will overwrite the existing image
            if (move_uploaded_file($photo["tmp_name"], $targetFile)) {
                $image_url = $targetFile;
            }
        }
        
        //update the product in the database
        $sql = $pdo->prepare("UPDATE clothes SET product_name = :productName, price = :price, quantity = :quantity, description = :description WHERE product_id = :product_id");
        $sql->bindParam(':productName', $productName);
        $sql->bindParam(':price', $price);
        $sql->bindParam(':quantity', $quantity);
        $sql->bindParam(':description', $description);
        $sql->bindParam(':product_id', $product_Id);
        $sql->execute();

        header("Location: products.php");
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product Details</title>
</head>

<body>
    <?php echo displayHead()?>
    <form action="edit.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Product Record:</legend>
            <label for="productId">Product ID:</label>
            <input type="text" id="productId" name="productId" required value="<?php echo $product->getProductID(); ?>"
                disabled>
            <input type="hidden" name="productId" value="<?php echo $product->getProductID(); ?>"><br><br>

            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName"
                value="<?php echo $product->getProductName(); ?>"><br><br>

            <label for="category">Category:</label>
            <select id="category" name="category" required disabled>
                <option value="" disabled>Select Category</option>
                <option value="Boots" <?php if($product->getCategory() == "Boots") echo "selected"; ?>>Boots</option>
                <option value="Shirts" <?php if($product->getCategory() == "Shirts") echo "selected"; ?>>Shirts</option>
                <option value="Leggings" <?php if($product->getCategory() == "Leggings") echo "selected"; ?>>Leggings
                </option>
            </select>
            <input type="hidden" name="category" value="<?php echo $product->getCategory(); ?>"><br><br>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" min="0" value="<?php echo $product->getPrice(); ?>"><br><br>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1"
                value="<?php echo $product->getQuantity(); ?>"><br><br>

            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" min="0" value="<?php echo $product->getRating(); ?>"
                disabled>
            <input type="hidden" name="rating" value="<?php echo $product->getRating(); ?>"><br><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="70"
                required><?php echo $product->getDescription(); ?></textarea><br><br>

            <label for="productPhoto">Product Photo:</label>
            <input type="file" id="productPhoto" name="productPhoto" accept=".jpeg">
            <br><br>

            <button type="submit">Update</button>
        </fieldset>
    </form>

    <?php echo displayFooter(); ?>
</body>

</html>