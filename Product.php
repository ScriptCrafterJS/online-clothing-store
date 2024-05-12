<?php
class Product{
    private $product_id;
    private $image_url;
    private $product_name;
    private $category;
    private $price;
    private $quantity;
    
    function __construct($parameters = array()){
        foreach($parameters as $key => $value){
            $this->$key = $value;
        }
    }

    public function outputAsRow(){
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
         <td><img src='images/$imagePath' alt='{$this->product_name}' width='200'></td>
         <td><a href=''>{$this->product_id}</a></td>
         <td>{$this->product_name}</td>
         <td>{$this->category}</td>
         <td>{$this->price}</td>
         <td>{$this->quantity}</td>
         <td>
         <button><img src='images/edit.png' alt='edit pen'></button>
         <button><img src='images/delete.png' alt='delete trash'></button>
         </td>
         </tr>
    REC;
        return $row;
    }
}

?>