<?php

namespace RestaurantLocations;

use Interfaces\FileConvertible;

class RestaurantLocation implements FileConvertible{
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private array $employees;
    private bool $isOpen;
    private bool $hasDriveThru;

    public function __construct(
        string $name,
        string $address,
        string $city,
        string $state,
        string $zipCode,
        array $employees,
        bool $isOpen,
        bool $hasDriveThru
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->employees = $employees;
        $this->isOpen = $isOpen;
        $this->hasDriveThru = $hasDriveThru;
    }

    public function createAllEmployeesHtml() : string {
        $html = "";
        for($i = 0; $i < count($this->employees); $i++){
            $employee = $this->employees[$i];
            $html .= $employee->toHtml();
        }

        return $html;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getAddress() : string {
        return $this->address;
    }

    public function getCity() : string {
        return $this->city;
    }

    public function getState() : string {
        return $this->state;
    }

    public function getZipCode() : string {
        return $this->zipCode;
    }

    public function toString() : string {
        return sprintf("Name: %s, Address: %s, City: %s, State: %s, Zip Code: %s, %s",
        $this->name,
        $this->address,
        $this->city,
        $this->state,
        $this->zipCode,
        $this->isOpen ? "We're Open" : "We're closed");
    }

    public function toHtml(): string{
        return sprintf('
            <div>
                <h4>Employees:</h4>
                <ul>
                    %s
                </ul>
            </div>
        ',
        $this->createAllEmployeesHtml()
    );
    }

    public function toMarkdown() : string {
        $openNow = $this->isOpen ? "We're Open" : "We're closed";
        return "## Name: {$this->name}
                - Address: {$this->address}
                - City: {$this->city}
                - State: {$this->state}
                - ZipCode: {$this->zipCode}
                - Open: {$openNow}";
    }

    public function toArray() : array {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode,
            'isOpen' =>$this->isOpen
        ];
    }
}