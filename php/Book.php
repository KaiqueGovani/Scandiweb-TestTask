<?php

class Book extends Product
{
    protected $weight;

    //Constructor
    public function __construct($id, $sku, $name, $price, $weight)
    {
        parent::__construct($id, $sku, $name, $price);
        $this->weight = $weight;
    }

    //Getters and Setters
    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getAttributes()
    {
        return "Weight: " . $this->getWeight() . " KG";
    }

    public function getInsertQuery()
    {
        return "INSERT INTO products (sku, name, price, type, weight) VALUES ('" . $this->getSku() . "', '" . $this->getName() . "', '" . $this->getPrice() . "', 'Book', '" . $this->getWeight() . "')";
    }

}