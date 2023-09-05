<?php

namespace Companies\RestaurantChains;

use Companies\Company;
use Interfaces\FileConvertible;
use RestaurantLocations\RestaurantLocation;

class RestaurantChain extends Company implements FileConvertible{
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
            $allRestaurantLocations .= $location->getName() . "\n";
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

    public function toString() : string {
        return sprintf("Chain ID: %d, Restaurant Locations: %s, Cuisine Type: %s,
        Number Of Locations: %d, Parent Company: %s",
        $this->chainId,
        $this->displayAllRestaurantLocations(),
        $this->cuisineType,
        $this->numberOfLocations,
        $this->parentCompany
        );
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

    public function toMarkdown() : string {
        return "## Chain ID: {$this->chainId}
                - Restaurant Locations: {$this->displayAllRestaurantLocations()}
                - Cuisine Type: {$this->cuisineType}
                - Number Of Locations: {$this->numberOfLocations}
                - Parent Company: {$this->parentCompany}
        ";
    }

    public function toArray() : array {
        return [
            'chainId' => $this->chainId,
            'restaurantLocations' => $this->restaurantLocations,
            'cuisineType' => $this->cuisineType,
            'numberOfLocations' => $this->numberOfLocations,
            'parentCompany' => $this->parentCompany
        ];
    }
}