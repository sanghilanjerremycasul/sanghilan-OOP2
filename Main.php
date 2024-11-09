<?php

class Main {

    private EmployeeRoster $roster;
    private $size;
    private $repeat;

    
    public function __construct() {

        $this->size = 0;
        $this->repeat = true;
    }

    public function start() {
        $this->clear();
        
        
        
        $this->size = readline("Enter the size of the roster: ");
        

        if ($this->size < 1) {
            echo "Invalid input. Please try again.\n";
            readline("Press \"Enter\" key to continue...");
            $this->start(); 
            return;
        }

        
        $this->roster = new EmployeeRoster($this->size);

        $this->entrance();
    }

    

    public function entrance() {
        
        while ($this->repeat) {
            $this->clear();
            $choice = $this->menu();
            switch ($choice) {
                case 1:
                    $this->addMenu();
                    break;
                case 2:
                    $this->deleteMenu();
                    break;
                case 3:
                    $this->otherMenu();
                    break;
                case 0:
                    system(exit);
                    break;
                default:
                    echo "Invalid input. Please try again.\n";
                    readline("Press \"Enter\" key to continue...");
                    $this->entrance();
                    break;
            }
        }
        echo "Process terminated.\n";
        exit;
    }

    public function menu() {
        $this->clear();
        echo "Enter the size of the roster: $this->size\n";
        echo "Available space on the roster: ". $this->roster->count() ."\n";
        echo "*** EMPLOYEE ROSTER MENU ***\n";
        echo "[1] Add Employee\n";
        echo "[2] Delete Employee\n";
        echo "[3] Other Menu\n";
        echo "[0] Exit\n";

        $choice = readline("Pick from the Menu: ");
        return $choice;
    }

    public function addMenu() {
        
        if ($this->roster->count() <= 0) {
            echo "Roster is full. Cannot add more employees.\n";
            readline("Press \"Enter\" key to continue...");
            $this->entrance(); 
            return;
        }
    
        $this->clear();
        echo "----- Add Employee ----- \n";
        echo "---Employee Details\n";
    
        $name = readline("Enter name: ");
        $address = readline("Enter address: ");
        $cName = readline("Enter company name: ");
        $age = readline("Enter age: ");
    
        $this->empType($name, $address, $age, $cName);
    }
    

    public function empType($name, $address, $age, $cName) {
        $this->clear();
        echo "---Employee Details \n";
        echo "Enter name: $name\n";
        echo "Enter address: $address\n";
        echo "Enter company name: $cName\n";
        echo "Enter age: $age\n";
        echo "[1] Commission Employee       [2] Hourly Employee       [3] Piece Worker\n";
        $type = readline("Type of Employee: ");
        switch ($type) {
            case 1:
                $this->addOnsCE($name,$address,$age,$cName);
                break;
            case 2:
                $this->addOnsHE($name,$address,$age,$cName);
                break;
            case 3:
                $this->addOnsPE($name,$address,$age,$cName);
                break;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->empType($name, $address, $age, $cName);
                break;
        }
    }

    public function addOnsCE($name, $address, $age, $cName) {
        $regularSalary = readline("Enter Regular Salary: ");
        $itemSold = readline("Enter # of Items: ");
        $commission_rate = readline("Enter Commission (%): ");

        $employee = new CommissionEmployee($name,$address,$age,$cName,$regularSalary,$itemSold,$commission_rate);

        $this->roster->addEmployees($employee);

        $this->repeat();

    }

    public function addOnsHE($name, $address, $age, $cName) {
        $workHour = readline("Enter hours worked: ");
        $rate = readline("Enter rate: ");

        $employee = new HourlyEmployee($name,$address,$age,$cName,$workHour,$rate);
        $this->roster->addEmployees($employee);

        $this->repeat();
    }

    public function addOnsPE($name, $address, $age, $cName) {
        $numberItems = readline("Enter number of items: ");
        $wagePerItem = readline("Enter wage per item: ");

        $employee = new PieceWorker($name, $address, $age, $cName, $numberItems, $wagePerItem);

        $this->roster->addEmployees($employee);

        $this->repeat();
    }

    public function deleteMenu() {
        $this->clear();
        
        echo "*** List of Employees in the Current Roster ***\n";
        $this->roster->displayForDelete();  // Use a method that displays employees with their slots for deletion
    
        $slot = readline("\nEnter the slot number of the employee to delete (or 0 to return): ");
        
        if ($slot == 0) {
            $this->entrance();
            return;
        }else{
            $this->deleteMenu();
            
        }
    
        // Convert slot to zero-indexed for internal use
        $slotIndex = $slot - 1;
    
        // Check if the slot is within a valid range and not empty
        if ($slotIndex >= 0 && $slotIndex < $this->roster->getSize()) {
            $employee = $this->roster->getRoster()[$slotIndex];
            
            if ($employee === null) {
                echo "Slot #$slot is empty. No employee to delete.\n";
            } else {
                // Remove the employee and re-index array
                $this->roster->removeEmployee($slotIndex);
                echo "Employee at slot #$slot has been removed.\n";
            }
        } else {
            echo "Invalid slot number.\n";
        }
    
        readline("Press \"Enter\" key to continue...");
        $this->deleteMenu();
    }
    

    public function otherMenu() {
        $this->clear();
        echo "[1] Display\n";
        echo "[2] Count\n";
        echo "[3] Payroll\n";
        echo "[0] Return\n";
        $choice = readline("Select Menu: ");

        switch ($choice) {
            case 1:
                $this->displayMenu();
                break;
            case 2:
                $this->countMenu();
                break;
            case 3:
                $this->displayPayroll();
                break;
            case 0:
                $this->entrance();
                break;

            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->otherMenu();
                break;
        }
    }

    public function displayPayroll() {
        $this->clear();
        echo "*** Employee Payroll ***\n";
        foreach ($this->roster->getRoster() as $employee) {
            if ($employee !== null) {
                echo $employee->displayDetails();
                echo "Earnings: " . $employee->earnings() . "\n";
                echo "--------------------------\n";
            }
        }
        readline("Press \"Enter\" key to continue...");
        $this->otherMenu();
    }

    public function displayMenu() {
        $this->clear();
        echo "[1] Display All Employee\n";
        echo "[2] Display Commission Employee\n";
        echo "[3] Display Hourly Employee\n";
        echo "[4] Display Piece Worker\n";
        echo "[0] Return\n";
        $choice = readline("Select Menu: ");

        switch ($choice) {
            case 0:
                $this->otherMenu();
                break;
            case 1:
                $this->roster->display();
                break;
            case 2:
                $this->roster->displayCE();
                break;
            case 3:
                $this->roster->displayHE();
                break;
            case 4:
                $this->roster->displayPE();
                break;

            default:
                echo "Invalid Input!";
                break;
        }

        readline("\nPress \"Enter\" key to continue...");
        $this->displayMenu();
    }

    public function countMenu() {
        $this->clear();
        echo "[1] Count All Employee\n";
        echo "[2] Count Commission Employee\n";
        echo "[3] Count Hourly Employee\n";
        echo "[4] Count Piece Worker\n";
        echo "[0] Return\n";
        $choice = readline("Select Menu: ");

        switch ($choice) {
            case 0:
                $this->otherMenu();
                break;
            case 1:
                $this->roster->countAll();
                break;
            case 2:
                $this->roster->countCE();
                break;
            case 3:
                $this->roster->countHE();
                break;
            case 4:
                $this->roster->countPE();
                break;

            default:
                echo "Invalid Input!";
                break;
        }


        readline("\nPress \"Enter\" key to continue...");
        $this->countMenu();
    }

    public function clear() {
        echo "\033[2J\033[;H";
    }   

    public function repeat() {
        
        if ($this->roster->count() > 0) {
            $c = readline("Add more? (y to continue): ");
            if (strtolower($c) == 'y') {
                $this->addMenu();
            } else {
                $this->entrance();
            }
        } else {
            echo "Roster is Full\n";
            readline("Press \"Enter\" key to continue...");
            $this->entrance();
        }
        echo "Employee Added!\n";
    }
    
    
}