<?php

class Person{
  private $name;
  private $address;
  private $age;
  public function __construct($name,$address,$age){
    $this->name = $name;
    $this->address = $address;
    $this->age = $age;
  }

  public function getName(){
    return $this->name;
  }

  public function getAddress(){
    return $this->address;
  }

  public function getAge(){
    return $this->age;
  }

  public function setName($name){
    $this->name = $name;
    return $name;
  }

  public function setAddress($address){
    $this->address = $address;
    return $address;
  }

  public function setAge($age){
    $this->age = $age;
    return $age;
  }

  
}