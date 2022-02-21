<?php

include "vendor/autoload.php";
include 'empolyee.php';
include 'department.php';


echo "Welcome to the demo! <br><br>";
//var_dump(realpath(dirname(__FILE__)));

$employee1 = new Employee(1,'Bob', 300, new DateTime('2009-01-14 0:0:0'));
$employee2 = new Employee(2,"Alexa", 128, new DateTime('2011-04-28 0:0:0'));
$employee3 = new Employee(3,"Laura", 1000, new DateTime('2011-11-05 0:0:0'));
$employee4 = new Employee(4,"Rojer", 550.50, new DateTime('2012-03-13 0:0:0'));

$department1 = new Department("Finance", array($employee1,$employee2,$employee3,$employee4));
$department2 = new Department("Second Finance", array($employee1,$employee2,$employee3,$employee4));
$department3 = new Department("Extra Finance", array($employee1,$employee4));

echo "Years of experience demo: <br>";
foreach($department1->employees as $employee)
{
    echo " {$employee->hire_date->format("Y-m-d H:i:s")} - experience: {$employee->getExperience()} years <br>";
}
echo "<br>";

$departments = [];
array_push($departments,$department1,$department2,$department3);

$max_salary=-1;
$max_employee_count_max = 0;
$min_salary=PHP_FLOAT_MAX;
$max_employee_count_min = 0;
foreach ($departments as $department)
{
    if ($department->getCollectiveSalary()>$max_salary)
    {
        $max_salary=$department->getCollectiveSalary();
        $max_employee_count_max=count($department->employees);
    }
    else if ($department->getCollectiveSalary()==$max_salary)
    {
        if (count($department->employees)>$max_employee_count_max)
        $max_employee_count_max=count($department->employees);
    }
    if ($department->getCollectiveSalary()<$min_salary)
    {
        $min_salary=$department->getCollectiveSalary();
        $max_employee_count_min=count($department->employees);
    }
    else if ($department->getCollectiveSalary()==$min_salary)
    {
        if (count($department->employees)>$max_employee_count_min)
        $max_employee_count_min=count($department->employees);
    }
}
echo "All departments with max salary: <br>";
foreach ($departments as $department)
{
    if ($department->getCollectiveSalary()==$max_salary & count($department->employees)==$max_employee_count_max) 
    {
        echo $department->name."<br>";
    }
    
}
echo "All departments with min salary: <br>";
foreach ($departments as $department){
    if ($department->getCollectiveSalary()==$min_salary & $department->getCollectiveSalary()==$min_salary)
        {
            echo $department->name."<br>";
        }
}