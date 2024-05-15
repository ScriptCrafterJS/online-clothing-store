<?php

    require_once('dpconfig.in.php');
    include_once('Product.php');

    $pdo = db_connect();

    //to check for the form if it was submitted or not
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
        $filter_by = isset($_POST['filter_by']) ? $_POST['filter_by'] : '';
        $category = isset($_POST['category']) ? $_POST['category'] : '';

        // setting a base sql statement so if no filters applied get all the products in the system
        $sql = "SELECT * FROM clothes WHERE 1=1";

        if (!empty($product_name) && !empty($filter_by)) {
            if ($filter_by === 'name') {
                $sql .= " AND product_name LIKE '%$product_name%'";
            } elseif ($filter_by === 'price') {
                //here cause the use might chose to type 80 in the input box and chose the price filter
                $sql .= " AND price >= '$product_name'";
            } elseif ($filter_by === 'category') {
                $sql .= " AND category = '$category'";
            }
        }
        if(!empty($category)){
            $sql .= " AND category = '$category'";
        }
        $result = $pdo->query($sql);
    } else {
        //get all clothes if the form was not submitted 
        $sql = "SELECT * FROM clothes";
        $result = $pdo->query($sql);
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    <main>
        <?php echo displayHead(); ?>
        <article>
            <p>to add a new product click on the following link <a href="add.php" aria-label="Add Product">Add
                    Product</a>.</p>
            <br>
            <p>or use the actions below to edit or delete a Product's record.</p>
            <fieldset>
                <legend>Advanced Product Search</legend>
                <form method="POST" action="products.php">
                    <input type="text" id="product_name" name="product_name" placeholder="Search Product Name">

                    <label><input type="radio" name="filter_by" value="name"> Name</label>
                    <label><input type="radio" name="filter_by" value="price"> Price</label>
                    <label><input type="radio" name="filter_by" value="category"> Category</label>

                    <select name="category">
                        <option value="" disabled selected>Select Category</option>
                        <option value="Shirts">Shirts</option>
                        <option value="Boots">Boots</option>
                        <option value="Leggings">Leggings</option>
                    </select>
                    <button type="submit">Filter</button>
                </form>
                <br>
                <table border="1">
                    <caption>Products Table Result</caption>
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result) {
                            while($product = $result->fetchObject('Product')){
                                echo $product->displayInTable();
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </fieldset>
        </article>
        <?php echo displayFooter(); ?>
    </main>
</body>

</html>