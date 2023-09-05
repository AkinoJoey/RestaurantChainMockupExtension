<?php

namespace Companies;

use Interfaces\FileConvertible;

class Company implements FileConvertible{
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

    public function toString() : string {
        return sprintf("Company Name: %s, Founding Year: %d, Description: %s, Website: %s, 
        Phone: %d, Industry: %s, CEO: %s, Publicly Traded: %s",
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

    public function toHtml() : string {
        return sprintf('
        <h2>Company Name: %s</h2>
        <p>Founding Year: %d</p>
        <p>Description: %s</p>
        <p>Website: %s</p>
        <p>Phone: %d</p>
        <p>Industry: %s</p>
        <p>CEO: %s</p>
        <p>Publicly Traded: %s</p>',
        $this->name,
        $this->foundingYear,
        $this->description,
        $this->website,
        $this->phone,
        $this->industry,
        $this->ceo,
        $this->isPubliclyTraded ? "Yes" : "No");
    }

    public function toMarkdown() : string {
        $publiclyTraded = $this->isPubliclyTraded ? "Yes" : "No";

        return "## Company Name: {$this->name}
                - Founding Year: {$this->foundingYear}
                - Description: {$this->description}
                - Website: {$this->website}
                - Phone: {$this->phone}
                - Industry: {$this->industry}
                - CEO: {$this->ceo}
                - Publicly Traded: {$publiclyTraded}";
    }

    public function toArray() : array {
        return [
            'name' => $this->name,
            'foundingYear' => $this->foundingYear,
            'description' => $this->description,
            'website'=> $this->website,
            'phone'=> $this->phone,
            'industry'=> $this->industry,
            'ceo'=> $this->ceo,
            'isPubliclyTraded' => $this->isPubliclyTraded
        ];
    }
}