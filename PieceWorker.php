<?php

class PieceWorker extends Employee{
  private $numberItems;
  private $wagePerItem;
  private $empType = "Piece Worker";  

  public function __construct($name,$address,$age,$cName,$numberItems,$wagePerItem){
    parent:: __construct($name,$address,$age,$cName);
    $this->numberItems = $numberItems;
    $this->wagePerItem = $wagePerItem;
  }

  public function __toString(){
    $name = parent::getName();
    $address = parent::getAddress();
    $age = parent::getAge();
    $cName = parent::getCompName();

    return "Name: $name\nAddress: $address\nAge: $age\nCompany Name: $cName\nNumber of Items: $this->numberItems\nWage per item: $this->wagePerItem\nType: $this->empType";
  }

  public function earnings(){
    $earnings = $this->numberItems * $this->wagePerItem;
    return $earnings;
  }

  public function displayDetails() {
    return "Name: " . parent::getName() . "\n" . 
           "Address: " . parent::getAddress() . "\n" .
           "Age: " . parent::getAge() . "\n" . 
           "Company Name: " . parent::getCompName() . "\nNumber of items: $this->numberItems\nWage per item: $this->wagePerItem\n";
  }

}