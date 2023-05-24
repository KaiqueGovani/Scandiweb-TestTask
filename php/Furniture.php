<?php

class Furniture extends Product
{
    protected $height;
    protected $width;
    protected $length;

    //Constructor
    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->height = $attributes['height'];
        $this->width = $attributes['width'];
        $this->length = $attributes['length'];
        $this->type = "Furniture";
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
        return "Dimensions: " . $this->height . " x " . $this->width . " x " . $this->length . " CM";
    }

    public function getInsertQuery()
    {
        return "INSERT INTO products (sku, name, price, type, height, width, length) VALUES ('" . $this->getSku() . "', '" . $this->getName() . "', '" . $this->getPrice() . "', '" . $this->getType() . "', '" . $this->getHeight() . "', '" . $this->getWidth() . "', '" . $this->getLength() . "')";
    }

}