<?php

namespace Helpers;

use Faker\Factory;
use Users\User;
use Users\Employee;
use Companies\Company;
use Companies\RestaurantChains\RestaurantChain;
use RestaurantLocations\RestaurantLocation;

class RandomGenerator {
    public static function user(): User {
        $faker = Factory::create();

        return new User(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email(),
            $faker->password(),
            $faker->phoneNumber(),
            $faker->address(),
            $faker->dateTimeThisCentury(),
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor'])
        );
    }
    public static function employee(int $minSalary = 20, int $maxSalary = 50): Employee {
        $faker = Factory::create();

        return new Employee(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email(),
            $faker->password(),
            $faker->phoneNumber(),
            $faker->address(),
            $faker->dateTimeThisCentury(),
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor']),
            $faker->jobTitle(),
            $faker->numberBetween($minSalary, $maxSalary),
            $faker->dateTime(),
            $faker->words()
        );
    }

    public static function company(): Company{
        $faker = Factory::create();

        return new Company(
            $faker->company(),
            $faker->numberBetween(1960, 2023),
            $faker->catchPhrase(),
            $faker->url(),
            $faker->phoneNumber(),
            $faker->word(),
            $faker->name(),
            $faker->boolean(),
            $faker->country(),
            $faker->name(),
            $faker->numberBetween(200, 2000000)
        );
    }

    public static function restaurantLocation(int $startZipCode = null, int $endZipCode = null, array $employees = null) : RestaurantLocation {
        $faker = Factory::create();

        if(is_null($startZipCode) || is_null($endZipCode)){
            $zipCode = $faker->postcode();
        }else{
            $randomNumber = mt_rand($startZipCode, $endZipCode);
            $zipCode = str_pad($randomNumber, 5, '0', STR_PAD_LEFT);
        }

        $employees = $employees ?? RandomGenerator::createObjects(2, 5, 'Helpers\RandomGenerator::employee');

        return new RestaurantLocation(
            $faker->streetName(),
            $faker->streetAddress(),
            $faker->city(),
            $faker->state(),
            $zipCode,
            $employees,
            $faker->boolean(),
            $faker->boolean()
        );
    }

    public static function restaurantChain(array $restaurantLocations) : RestaurantChain {
        $faker = Factory::create();

        $restaurantLocations = $restaurantLocations ?? RandomGenerator::createObjects(2,5,'Helpers\RandomGenerator::restaurantLocation');
        return new RestaurantChain(
            $faker->company(),
            $faker->numberBetween(1960, 2023),
            $faker->catchPhrase(),
            $faker->url(),
            $faker->phoneNumber(),
            $faker->word(),
            $faker->name(),
            $faker->boolean(),
            $faker->country(),
            $faker->name(),
            $faker->numberBetween(200, 2000000),
            $faker->randomNumber(),
            $restaurantLocations,
            $faker->word(),
            $faker->company()
        );
    }

    public static function createObjects(int $min, int $max, callable $callback): array {
        $faker = Factory::create();
        $objects = [];
        $numOfObjects = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfObjects; $i++) {
            $objects[] = call_user_func($callback);
        }

        return $objects;
    }


    public static function createEmployees(int $numberOfEmployees, int $minSalary, int $maxSalary) : array {
        $employees = [];

        for($i = 0; $i < $numberOfEmployees; $i++){
            $employees[] = RandomGenerator::employee($minSalary, $maxSalary);
        }

        return $employees;
    }

    public static function generateRestaurantLocations(int $min , int $max, int $numberOfEmployees, int $minSalary, int $maxSalary, int $startZipCode, int $endZipCode) : array {
        $faker = Factory::create();
        $restaurantLocations = [];
        $numOfObjects = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfObjects; $i++) {
            $employees = self::createEmployees($numberOfEmployees, $minSalary, $maxSalary);
            $restaurantLocations[] = self::restaurantLocation($startZipCode, $endZipCode, $employees);
        }

        return $restaurantLocations;
    }

    public static function makeRestaurantChains(int $min , int $max, int $numberOfEmployees, int $minSalary, int $maxSalary, int $startZipCode, int $endZipCode): array{
        $faker = Factory::create();
        $restaurantChains = [];
        $numOfObjects = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfObjects; $i++) {
            $restaurantLocations = self::generateRestaurantLocations($min, $max, $numberOfEmployees, $minSalary, $maxSalary, $startZipCode, $endZipCode);
            $restaurantChains[] = self::restaurantChain($restaurantLocations);
        }
        return $restaurantChains;
    }

}
?>