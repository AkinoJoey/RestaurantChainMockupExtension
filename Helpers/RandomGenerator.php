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
    public static function employee(): Employee {
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
            $faker->numberBetween(20, 50),
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

    public static function restaurantLocation() : RestaurantLocation {
        $faker = Factory::create();

        return new RestaurantLocation(
            $faker->streetName(),
            $faker->streetAddress(),
            $faker->city(),
            $faker->state(),
            $faker->postcode(),
            self::createObjects(20, 100, 'self::employee'),
            $faker->boolean(),
            $faker->boolean()
        );
    }

    public static function restaurantChain() : RestaurantChain {
        $faker = Factory::create();

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
            self::createObjects(1,20,'self::restaurantLocation'),
            $faker->word(),
            $faker->numberBetween(1,100),
            $faker->company()
        );
    }

    public static function createObjects(int $min, int $max, callable $callback): array {
        $faker = Factory::create();
        $objects = [];
        $numOfObjects = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfObjects; $i++) {
            $objects[] = self::$callback();
        }

        return $objects;
    }
}
?>