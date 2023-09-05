<?php

namespace Companies\RestaurantChains;

use Companies\Company;
use RestaurantLocations\RestaurantLocation;

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
        parent::__construct($name, $foundingYear, $description, $website, $phone,
        $industry, $ceo, $isPubliclyTraded, $country, $founder, $totalEmployees);

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
        $allRestaurantLocations = "";

        for($i = 0; $i < count($this->restaurantLocations); $i++){
            $location = $this->restaurantLocations[$i];
            $allRestaurantLocations .= $location->returnDetail() . "\n";
        }

        return $allRestaurantLocations;
    }

    public function createAllLocationsHtml() : string {
        $html = "";
        for($i = 0; $i < count($this->restaurantLocations); $i++){
            $restaurantLocation = $this->restaurantLocations[$i];
            $html .=  sprintf('
            <details>
                <summary role="button" class="secondary">%s</summary>
                <p>Company Name: %s,  Address: %s, ZipCode: %s</p>
                %s
            </details>
            ',
            $restaurantLocation->getName(),
            $this->parentCompany,
            $restaurantLocation->getAddress() . ", " . $restaurantLocation-> getCity() . ", " . $restaurantLocation->getState(),
            $restaurantLocation->getZipCode(),
            $restaurantLocation->toHTML());
        }

        return $html;
    }

    public function toHtml(): string{
        return sprintf('
        <article>
            <header>%s</header>
            %s
        </article>
        ',
        $this->name,
        $this->createAllLocationsHtml());
    }
}