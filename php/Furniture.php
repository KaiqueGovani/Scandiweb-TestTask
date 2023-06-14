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

    public function validateAttributes($data)
    {
        $height = $this->getHeight();
        $width = $this->getWidth();
        $length = $this->getLength();
        $error = "";

        if (!isset($height) || $height == "") {
            $error = "Height is required";
        } else if (!is_numeric($height)) {
            $error = "Height must be a number";
        } else if ($height < 0) {
            $error = "Height must be a positive number";
            
        } else if (!isset($width) || $width == "") {
            $error = "Width is required";
        } else if (!is_numeric($width)) {
            $error = "Width must be a number";
        } else if ($width < 0) {
            $error = "Width must be a positive number";

        } else if (!isset($length) || $length == "") {
            $error = "Length is required";
        } else if (!is_numeric($length)) {
            $error = "Length must be a number";
        } else if ($length < 0) {
            $error = "Length must be a positive number";
        }
        
        return $error;
    }

}