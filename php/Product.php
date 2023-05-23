<?php

abstract class Product
{
    protected $id;
    protected $sku;
    protected $name;
    protected $price;


    //Constructor
    public function __construct($attributes)
    {
        $this->id = $attributes['id'];    
        $this->sku = $attributes['sku'];
        $this->name = $attributes['name'];
        $this->price = $attributes['price'];
    }

    //Getters and Setters
    public function getSku()
    {
        return $this->sku;
    }

    public function setSKU($sku)
    {
        $this->sku = $sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    //Abstract methods to be implemented by subclasses
    abstract public function getAttributes();
    abstract public function getInsertQuery();

}