<?php

namespace RestaurantLocations;

class RestaurantLocation{
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

    public function returnDetail() : string {
        return sprintf("Name: %s, Address: %s, City: %s, State: %s, Zip Code: %s, %s",
        $this->name,
        $this->address,
        $this->city,
        $this->state,
        $this->zipCode,
        $this->isOpen ? "We're Open" : "We're closed"
    );
    }
}