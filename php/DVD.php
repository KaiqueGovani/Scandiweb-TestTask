<?php

class DVD extends Product
{
    protected $size;
    
    //Constructor
    public function __construct($id, $sku, $name, $price, $size)
    {
        parent::__construct($id, $sku, $name, $price);
        $this->size = $size;
    }

    //Getters and Setters
    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getAttributes()
    {
        return "Size: " . $this->getSize() . " MB";
    }

    public function getInsertQuery()
    {
        return "INSERT INTO products (sku, name, price, type, size) VALUES ('" . $this->getSku() . "', '" . $this->getName() . "', '" . $this->getPrice() . "', 'DVD', '" . $this->getSize() . "')";
    }

}
