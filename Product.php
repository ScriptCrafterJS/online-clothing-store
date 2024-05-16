<?php
class Product{
    private $product_id;
    private $image_url;
    private $product_name;
    private $category;
    private $price;
    private $quantity;
    private $description;
    private $rating;
    
    function __construct($parameters = array()){
        foreach($parameters as $key => $value){
            $this->$key = $value;
        }
    }

    public function getProductID(){
        return $this->product_id;
    }

    public function setProductID($product_id){
        $this->product_id = $product_id;
    }

    public function getImageURL(){
        return $this->image_url;
    }

    public function setImageURL($image_url){
        $this->image_url = $image_url;
    }

    public function getProductName(){
        return $this->product_name;
    }

    public function setProductName($product_name){
        $this->product_name = $product_name;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($category){
        $this->category = $category;
    }
    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }
    public function getRating(){
        return $this->rating;
    }

    public function setRating($rating){
        $this->rating = $rating;
    }

    public function displayInTable(){
        $imagePath = $this->image_url;
        if ($this->category === 'Boots') {
            $imagePath = 'boots/'.$this->image_url;
        } elseif ($this->category === 'Shirts') {
            $imagePath = 'shirts/'.$this->image_url;
        } elseif ($this->category === 'Leggings') {
            $imagePath = 'leggings/'.$this->image_url;
        }
        $row = <<<REC
         <tr>
         <td><figure><img src='images/$imagePath' alt='$this->product_name' width='200'></figure></td>
         <td><a href='view.php?product_id=$this->product_id'>$this->product_id</a></td>
         <td>$this->product_name</td>
         <td>$this->category</td>
         <td>$this->price</td>
         <td>$this->quantity</td>
         <td>
         <button type="button"><a href='edit.php?product_id=$this->product_id'><img src='images/edit.png' alt='edit pen'></button>
         <button type="button"><a href='delete.php?product_id=$this->product_id'><img src='images/delete.png' alt='delete trash'></button>
         </td>
         </tr>
    REC;
        return $row;
    }

    public function displayProductPage(){
        $imagePath = $this->image_url;
        if ($this->category === 'Boots') {
            $imagePath = 'boots/'.$this->image_url;
        } elseif ($this->category === 'Shirts') {
            $imagePath = 'shirts/'.$this->image_url;
        } elseif ($this->category === 'Leggings') {
            $imagePath = 'leggings/'.$this->image_url;
        }
        $productHTML = <<<REC
        <figure><img src='images/$imagePath' alt='{$this->product_name}' width='200'></figure>
        <h2>Product ID: $this->product_id, $this->product_name</h2>
        <ul>
        <li>Price: $this->price</li>
        <li>Category: $this->category</li>
        <li>Rating: $this->rating/5</li>
        </ul>
        <h2>Description:</h2>
        <p>$this->description</p>
    REC;
        return $productHTML;
    }
}

?>