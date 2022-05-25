<?php
class Product
{
    private $_id;
    private $_name;
    private $_catId;
    private $_price;
    private $_description;
    private $_image;

    public function __construct($id,$name, $catId,$price,$description, $image) {
        $this->_id = $id;
        $this->_name = $name;
        $this->_catId = $catId;
        $this->_price = $price;
        $this->_description = $description;
        $this->_image = $image;
    }

    public function id()
    {
        return $this->_id;
    }

    public function name()
    {
        return $this->_name;
    }

    public function catId()
    {
        return $this->_catId;
    }

    public function price()
    {
        return $this->_price;
    }

    public function description()
    {
        return $this->_description;
    }
    public function image()
    {
        return $this->_image;
    }
}
?>
