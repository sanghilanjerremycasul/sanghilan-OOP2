<?php


class EmployeeRoster {

  private array $roster;
  private int $size;
  private int $count;

  public function __construct($roster_size) {
    $this->roster = array_fill(0, $roster_size, null);
    $this->size = $roster_size;
    $this->count = 0;
  }

  public function getRoster(): array {
    return $this->roster;
  }

  public function getSize(): int {
    return $this->size;
  }

  public function addEmployees(Employee $employee) {
    for ($i = 0; $i < $this->size; $i++) {
      if ($this->roster[$i] === null) {
          $this->roster[$i] = $employee;
          $this->count++;
          return true;
      }
    }
    return false;
  }

  public function removeEmployee(int $index) {
    if (isset($this->roster[$index])) {
      $this->roster[$index] = null;
      $this->count--;
    }
  }

  public function count(): int {
    return $this->size - $this->count;
  }

  public function displayForDelete() {
    foreach ($this->roster as $index => $employee) {
        if ($employee !== null) {
            echo "Employee #" . ($index + 1) . "\n";
            echo $employee . "\n\n";
        }
    }
  }

  public function display() {
    $i = 1; 
    foreach ($this->roster as $employee) {
        if ($employee !== null) { 
            echo "\nEmployee #$i\n";
            echo $employee . "\n\n";
            $i++; 
        }
    }
  }

  public function displayCE(){
    $i = 1;
    echo "---Commission Employee---\n";
    foreach($this->roster as $employee){
      if($employee instanceof CommissionEmployee){
        echo "Employee #$i\n";
        echo $employee . "\n\n";
        $i++;
      }
    }
  }

  public function displayHE(){
    $i = 1;
    echo "---Hourly Employee---\n";
    foreach($this->roster as $employee){
      if($employee instanceof HourlyEmployee){
        echo "Employee #$i\n";
        echo $employee . "\n\n";
        $i++;
      }
    }
  }

  public function displayPE(){
    $i = 1;
    echo "---Piece Worker Employee---\n";
    foreach($this->roster as $employee){
      if($employee instanceof PieceWorker){
        echo "Employee #$i\n";
        echo $employee . "\n\n";
        $i++;
      }
    }
  }

  public function countCE(){
    $count = 0;
    foreach ($this->roster as $employee) {
        if ($employee instanceof CommissionEmployee){
            $count++;
        }
    }
    if($count === 0){
      echo "No Commission Employee";
    }else{
    echo "The total Commission Employee is $count";
    }
  }

  public function countHE(){
    $count = 0;
    foreach ($this->roster as $employee) {
        if ($employee instanceof HourlyEmployee){
            $count++;
        }
    }
    if($count === 0){
      echo "No Hourly Employee";
    }else{
    echo "The total Hourly Employee is $count";
    }
  }

  public function countPE(){
    $count = 0;
    foreach ($this->roster as $employee) {
        if ($employee instanceof PieceWorker){
            $count++;
        }
    }
    if($count === 0){
      echo "No Piece Worker Employee";
    }else{
    echo "The total Piece Worker Employee is $count";
    }
  }

  public function countAll(){
    $count = 0;
    foreach($this->roster as $employees){
      if($employees){
        $count++;
      }
    }
    if($count === 0){
      echo "No employees";
    }else{
      echo "The Total Employees is $count";
    }
  }

  public function displayEarnings() {
    foreach ($this->roster as $index => $employee) {
        if ($employee !== null) {
            echo "Employee #" . ($index + 1) . " Earnings: " . $employee->earnings() . "\n";
        }
    }
  }

}
