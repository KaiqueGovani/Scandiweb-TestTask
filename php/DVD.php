<?php

class DVD extends Product
{
    protected $size;

    //Constructor
    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->size = $attributes['size'];
        $this->type = "DVD";
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
        return "INSERT INTO products (sku, name, price, type, size) VALUES ('" . $this->getSku() . "', '" . $this->getName() . "', '" . $this->getPrice() . "', '" . $this->getType() . "', '" . $this->getSize() . "')";
    }

    public function validateAttributes($data)
    {
        $size = $this->getSize();
        $error = '';
        if (!isset($size) || $size == "") {
            $error = "Size is required";
        } else if (!is_numeric($size)) {
            $error = "Size must be a number";
        } else if ($size < 0) {
            $error = "Size must be a positive number";
        }
        return $error;
    }

}