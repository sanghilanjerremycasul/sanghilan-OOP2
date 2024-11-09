<?php

class CommissionEmployee extends Employee {
  private $regularSalary;
  private $itemSold;
  private $commissionRate;
  private $empType = "Commission";

  public function __construct($name, $address, $age, $cName, $regularSalary, $itemSold, $commissionRate) {
    parent::__construct($name, $address, $age, $cName);
    $this->regularSalary = $regularSalary;
    $this->itemSold = $itemSold;
    $this->commissionRate = $commissionRate / 100; // Convert to decimal
  }

  public function __toString() {
    $name = parent::getName();
    $address = parent::getAddress();
    $age = parent::getAge();
    $cName = parent::getCompName();

    return "Name: $name\nAddress: $address\nAge: $age\nCompany Name: $cName\nRegular Salary: $this->regularSalary\nSold Items: $this->itemSold\nCommission Rate: $this->commissionRate\nType: $this->empType";
  }

  public function displayDetails() {
    return "Name: " . parent::getName() . "\n" . 
           "Address: " . parent::getAddress() . "\n" .
           "Age: " . parent::getAge() . "\n" . 
           "Company Name: " . parent::getCompName() . "\n" . 
           "Regular Salary: $this->regularSalary\nItem Sold: $this->itemSold\nCommission Rate: $this->commissionRate\n";
  }

  public function earnings() {
    return $this->regularSalary + ($this->itemSold * $this->commissionRate);
  }



}
  