<?php

class DVD extends Product
{
    protected $size;
    
    //Constructor
    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->size = $attributes['size'];
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
