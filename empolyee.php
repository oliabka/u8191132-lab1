<?php

include "vendor/autoload.php";

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Employee{
    public int $id;
    public string $name;
    public float $salary;
    public DateTime $hire_date;

    /**S
     * @param int $id - employee identification number
     * @param string $name - employee name
     * @param float $salary - employee salary
     * @param DateTime $hire_date - date of hiring
     */
    public function __construct($id, $name, $salary, $hire_date)
    {
        $this->id = $id;
        $this->name = $name;
        $this->salary = $salary;
        $this->hire_date = $hire_date;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints("id", [
            new Assert\Length(['min' => 1,
                'max' => 16]),
            new Assert\NotBlank(),
        ]);
        $metadata->addPropertyConstraints("name", [
            new Assert\NotBlank(),
            new Assert\Regex([
                'pattern' => '/^([А-ЯЁ]{1}[а-яё]{29})|([A-Z]{1}[a-z]{29})$/u'
            ])
            ]);
        $metadata->addPropertyConstraints("salary", [
            new Assert\PositiveOrZero(),
            new Assert\NotBlank()
        ]);
        $metadata->addPropertyConstraints("hire_date", [
            new Assert\DateTime(),
            new Assert\NotBlank()
        ]);
    }

      /**
     * This method returns the amount of years passed since hiring
     * @return int - amount of full years since hiring
     */
    public function getExperience (): int
    {  
        $now = new DateTime("now");
        return (int)date_diff($this->hire_date, $now)->format('%y');
    }
}