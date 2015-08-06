<?php
class Car
{
    private $make_model;
    private $price;
    private $miles;
    private $photo;

    function __construct($make_model, $price, $miles, $photo)
    {
      $this->make_model = $make_model;
      $this->price = $price;
      $this->miles = $miles;
      $this->photo = $photo;
    }
    function setModel($new_make_model)
    {
        $this->make_model = (string) $new_make_model;
    }
    function getModel()
    {
        return $this->make_model;
    }
    function setPrice($new_price)
    {
        $this->price = (float) $new_price;
    }
    function getPrice()
    {
        return $this->price;
    }
    function setMiles($new_miles)
    {
        $this->miles = (float) $new_miles;
    }
    function getMiles()
    {
        return $this->miles;
    }
    function setPhoto($new_photo)
    {
        $this->photo = (string) $new_photo;
    }
    function getPhoto()
    {
        return $this->photo;
    }
}

?>
