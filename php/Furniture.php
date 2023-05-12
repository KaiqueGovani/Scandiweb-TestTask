<?php

class Furniture extends Product
{
    protected $height;
    protected $width;
    protected $length;
    
    //Constructor
    public function __construct($id, $sku, $name, $price, $height, $width, $length)
    {
        parent::__construct($id, $sku, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    //Getters and Setters
    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function getAttributes()
    {
        return "Dimensions: " . $this->height . "x" . $this->width . "x" . $this->length;
    }

    public function save()
    {
        // Logic to save Furniture product to the database
        // Implement the saving mechanism according to your project requirements
    }

    public function delete()
    {
        // Logic to delete a product from the database
    }
}