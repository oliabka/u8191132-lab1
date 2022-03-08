<?php

include "vendor/autoload.php";
include 'empolyee.php';
include 'department.php';

use Symfony\Component\Validator\ValidatorBuilder;

echo "Welcome to the validation demo! <br>";

function validateEmployee(Employee $employee) {
    $validator = (new ValidatorBuilder())->addMethodMapping('loadValidatorMetadata')->getValidator();
    $errors = $validator->validate($employee);
    if(count($errors) > 0) {
        foreach ($errors as $error) {
            echo $error."<br>";
        }
    }
}


$employee1 = new Employee(12345678901234567,'Bob', 300, new DateTime('2011-01-14 0:0:0'));
$employee2 = new Employee(2,"Al3xa", 128, new DateTime('2011-04-28 0:0:0'));
$employee3 = new Employee(3,"Laura", -100, new DateTime('2011-11-05 0:0:0'));
$employee4 = new Employee(4,"Rojer", 550.50, new DateTime('2012/02/13'));
$employees = [];
array_push($employees,$employee1,$employee2,$employee3,$employee4);

foreach ($employees as $employee) {
    validateEmployee($employee);
}