<?php

namespace Users;

use DateTime;
use Users\User;
use Interfaces\FileConvertible;
class Employee extends User implements FileConvertible{
    private string $jobTitle;
    private float $salary;
    private DateTime $startDate;
    private array $awards;

    public function __construct(
        int $id, string $firstName, string $lastName, string $email, 
        string $password, string $phoneNumber, string $address, 
        DateTime $birthDate, DateTime $membershipExpirationDate, string $role,
        string $jobTitle, float $salary, DateTime $startDate, array $awards
    ) {
        parent::__construct(
            $id,
            $firstName,
            $lastName,
            $email,
            $password,
            $phoneNumber,
            $address,
            $birthDate,
            $membershipExpirationDate,
            $role
        );
        $this->jobTitle = $jobTitle;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awards = $awards;

    }
    
    public function returnEmployeeDetail() : string {
        return sprintf("Job Title: %s, Salary: %d, Start Date: %s, Awards: ",
        $this->jobTitle,
        $this->salary,
        $this->startDate->format('Y-m-d'),
        implode(", ",$this->awards)
        );
    }

    public function toString() : string {
        return sprintf("ID: %d, Job Title: %s, %s %s, Salary: %d ,Start Date: %s",
        $this->id,
        $this->jobTitle,
        $this->firstName,
        $this->lastName,
        $this->salary,
        $this->startDate->format('Y-m-d')
        );
    }

    public function toHTML() : string {
        return sprintf("<li>ID: %d, Job Title: %s, %s %s, Salary: %d ,Start Date: %s</li>",
        $this->id,
        $this->jobTitle,
        $this->firstName,
        $this->lastName,
        $this->salary,
        $this->startDate->format('Y-m-d')
        );
    }

    public function toMarkdown(): string{
        return "## ID: {$this->id}git
                - Job Title: {$this->jobTitle}
                - Name: {$this->firstName} {$this->lastName}
                - Salary: {$this->salary}
                - Start Date: {$this->startDate}";
    }

    public function toArray(): array{
        return [
            'id' => ${$this->id},
            'jobTitle' => ${$this->jobTitle},
            'firstName' => ${$this->firstName},
            'lastName' => ${$this->lastName},
            'Salary' => ${$this->salary},
            'startDate' => ${$this->startDate}
        ];
    }
}