<?php

class HourlyEmployee extends Employee {
  private $hoursWorked;
  private $rate;
  private $empType = "Hourly Employee";

  public function __construct($name, $address, $age, $cName, $hoursWorked, $rate) {
    parent::__construct($name, $address, $age, $cName);
    $this->hoursWorked = $hoursWorked;
    $this->rate = $rate;
  }

  public function __toString() {
    $name = parent::getName();
    $address = parent::getAddress();
    $age = parent::getAge();
    $cName = parent::getCompName();
    
    return "Name: $name\nAddress: $address\nAge: $age\nCompany Name: $cName\nHours of Work: $this->hoursWorked\nRate: $this->rate\nType: $this->empType";
  }

  public function earnings() {
    if ($this->hoursWorked > 40) {
      $regularEarnings = 40 * $this->rate;
      $overtimeEarnings = ($this->hoursWorked - 40) * ($this->rate * 1.5);
      $totalEarnings = $regularEarnings + $overtimeEarnings;
    } else {
      $totalEarnings = $this->hoursWorked * $this->rate;
    }
    
    return $totalEarnings;
  }

  public function displayDetails() {
    return "Name: " . parent::getName() . "\n" . 
           "Address: " . parent::getAddress() . "\n" .
           "Age: " . parent::getAge() . "\n" . 
           "Company Name: " . parent::getCompName() . "\nHours Worked: $this->hoursWorked\nRate: $this->rate\n";
  }
}
