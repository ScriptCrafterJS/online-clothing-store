<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    <main>
        <header>
            <p>to add a new product click on the following link <a href="" aria-label="Add Product">Add Product</a>.</p>
            <br>
            <p>or use the actions below to edit or delete a Product's record.</p>
            <fieldset>
                <legend>Advanced Product Search</legend>
                <form>
                    <input type="text" id="productName" name="productName" placeholder="Search Product Name">

                    <label><input type="radio" name="searchBy" value="name"> Name</label>
                    <label><input type="radio" name="searchBy" value="price"> Price</label>
                    <label><input type="radio" name="searchBy" value="category"> Category</label>

                    <select name="category">
                        <option value="" disabled selected>Select Category</option>
                        <option value="category1">Shirts</option>
                        <option value="category2">Boots</option>
                        <option value="category3">Leggings</option>
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
                        <tr>
                            <td><img src="images/cotton-shirt.jpg" alt="Shippify Cotton Shirt" width="200"></td>
                            <td><a href="">112</a></td>
                            <td>Shippify Cotton Shirt</td>
                            <td>Shirts</td>
                            <td>60</td>
                            <td>20</td>
                            <td>
                                <button><img src="images/edit.png" alt="edit pen"></button>
                                <button><img src="images/delete.png" alt="delete trash"></button>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="images/wings-shirt.jpg" alt="Wings Shirt" width="200"></td>
                            <td><a href="">113</a></td>
                            <td>Wings Shirt</td>
                            <td>Shirts</td>
                            <td>80</td>
                            <td>15</td>
                            <td>
                                <button><img src="images/edit.png" alt="edit pen"></button>
                                <button><img src="images/delete.png" alt="delete trash"></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </header>
    </main>
</body>

</html>