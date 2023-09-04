<?php

namespace Companies\RestaurantChains;

use Companies\Company;
use RestaurantLocation;

class RestaurantChain extends Company{
    private int $chainId;
    private array $restaurantLocations;
    private string $cuisineType;
    private int $numberOfLocations;
    private string $parentCompany;

    public function __construct(
        string $name, int $foundingYear, string $description,string $website,
        string $phone,string $industry, string $ceo,bool $isPubliclyTraded,
        string $country,string $founder,int $totalEmployees,int $chainId,
        array $restaurantLocations, string $cuisineType, int $numberOfLocations,
        string $parentCompany
    ) {
        $this->chainId = $chainId;
        $this->restaurantLocations = $restaurantLocations;
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
        $this->parentCompany = $parentCompany;
    }

    public function addRestaurantLocation(RestaurantLocation $restaurantLocation) : void {
        array_push($this->restaurantLocations, $restaurantLocation);
    }

    public function displayAllRestaurantLocations() : string {
        return implode(", ",$this->restaurantLocations);
    }
}