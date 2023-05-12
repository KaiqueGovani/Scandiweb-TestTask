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
        return $this->getWeight();
    }

    public function save()
    {
        // Logic to save DVD product to the database
        // Implement the saving mechanism according to your project requirements
    }

    public function delete()
    {
        // Logic to delete a product from the database
    }
}