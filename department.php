<?php

include "vendor/autoload.php";
include "employee.php";


class Department{
    public string $name;
    public $employees;

    /**
     * @param string $name - department name
     * @param $employees - an array of all employees if this department
     */
    public function __construct($name, $employees)
    {
        $this->name = $name;
        $this->employees = $employees;
    }
    
    /**
     * This method returns the sum of slaries of all employees
     * @return float $collective_salary - sum of slaries of all employees
     */
    public function getCollectiveSalary(): float
    {
        $collective_salary = 0.0;
        foreach ($this->employees as &$employee)
        {
            $collective_salary+=$employee->salary;
        }
        return $collective_salary;
    }

}