<?php

namespace Companies;

use Interfaces\FileConvertible;

class Company{
    protected string $name;
    protected int $foundingYear;
    protected string $description;
    protected string $website;
    protected string $phone;
    protected string $industry;
    protected string $ceo;
    protected bool $isPubliclyTraded;
    protected string $country;
    protected string $founder;
    protected int $totalEmployees;

    public function __construct(
        string $name, int $foundingYear, string $description,string $website,
        string $phone,string $industry, string $ceo,bool $isPubliclyTraded,
        string $country,string $founder,int $totalEmployees
    ) {
        $this->name = $name;
        $this->foundingYear = $foundingYear;
        $this->description = $description;
        $this->website = $website;
        $this->phone = $phone;
        $this->industry = $industry;
        $this->ceo = $ceo;
        $this->isPubliclyTraded = $isPubliclyTraded;
        $this->country = $country;
        $this->founder = $founder;
        $this->totalEmployees = $totalEmployees;
    }

    public function returnCompanyDetail(): string{
        return sprintf("Company Name: %s, Founding Year: %d, Description: %s, Website: %s, Phone: %d, Industry: %s, CEO: %s, Publicly Traded: %s",
        $this->name,
        $this->foundingYear,
        $this->description,
        $this->website,
        $this->phone,
        $this->industry,
        $this->ceo,
        $this->isPubliclyTraded ? "Yes" : "No"
    );
    }
}