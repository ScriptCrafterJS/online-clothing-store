<?php

    require_once('dpconfig.in.php');
    include_once('Product.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productName = $_POST['productName'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $rating = $_POST['rating'];
        $description = $_POST['description'];
        
        //connect to the database
        $pdo = db_connect();
        
        //fetch the last added element
        $sql = $pdo->prepare("SELECT * FROM clothes ORDER BY product_id DESC LIMIT 1");
        $sql->execute();
        $lastElement = $sql->fetchObject('Product');

        if (!$lastElement) {
            $lastId = 1; //if no elements found, start from 1
        } else {
            $lastId = $lastElement->getProductID() + 1; // Increment last id by 1
        }
        
        //handle file upload
        if (isset($_FILES['productPhoto'])) {
            //move the uploaded file to the desired directory
            $photo = $_FILES['productPhoto'];
            $targetDir = "images/".$category."/";
            //basename() extracts the filename from the path of the uploaded file
            $imageName = basename($photo["name"]);
            
            //change the file name to be dedicated to its id
            $extension = pathinfo($imageName, PATHINFO_EXTENSION);//jpeg
            //rename the image file
            $newImageName = $lastId . "." . $extension;

            $targetFile = $targetDir . $newImageName;
            if (move_uploaded_file($photo["tmp_name"], $targetFile)) {
                $image_url = $targetFile;
            } else {
                die("There was an error uploading your file.");
            }
        } else {
            die("File upload failed.");
        }
        
        //insert the product into the database
        $sql = "INSERT INTO clothes (product_id, product_name, category, price, quantity, rating, description, image_url) 
                VALUES (:product_id, :productName, :category, :price, :quantity, :rating, :description, :image_url)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':product_id', $lastId);
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image_url', $newImageName);
        $stmt->execute();

        header('Location: products.php');
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
</head>

<body>
    <?php echo displayHead()?>
    <form action="add.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Product Record:</legend>
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" required><br><br>
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select Category</option>
                <option value="Boots">Boots</option>
                <option value="Shirts">Shirts</option>
                <option value="Leggings">Leggings</option>
            </select><br><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required min="0"><br><br>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required min="1"><br><br>
            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" required min="0"><br><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="70" required></textarea><br><br>
            <label for="productPhoto">Product Photo:</label>
            <input type="file" id="productPhoto" name="productPhoto" accept=".jpeg" required>
            <br>
            <br>
            <button type="submit">Insert</button>
        </fieldset>
    </form>
    <?php echo displayFooter(); ?>
</body>

</html>