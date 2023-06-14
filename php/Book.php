<?php

class Book extends Product
{
    protected $weight;

    //Constructor
    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->weight = $attributes['weight'];
        $this->type = "Book";
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
        return "INSERT INTO products (sku, name, price, type, weight) VALUES ('" . $this->getSku() . "', '" . $this->getName() . "', '" . $this->getPrice() . "', '" . $this->getType() . "', '" . $this->getWeight() . "')";
    }

    

    public function validateAttributes($data)
    {
        $weight = $this->getWeight();
        $error = '';
        if (!isset($weight) || $weight == "") {
            $error = "Weight is required";
        } else if (!is_numeric($weight)) {
            $error = "Weight must be a number";
        } else if ($weight < 0) {
            $error = "Weight must be a positive number";
        }
        return $error;
    }

}