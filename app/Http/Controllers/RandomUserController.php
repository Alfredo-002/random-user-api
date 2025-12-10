<?php

namespace App\Http\Controllers;

use Faker\Factory as Faker;

class RandomUserController extends Controller
{
    public function generate()
    {
        $faker = Faker::create();

        $user = [
            "gender" => $faker->randomElement(['male', 'female']),
            "name" => [
                "title" => $faker->title,
                "first" => $faker->firstName,
                "last" => $faker->lastName,
            ],
            "location" => [
                "street" => [
                    "number" => $faker->buildingNumber,
                    "name"   => $faker->streetName,
                ],
                "city" => $faker->city,
                "state" => $faker->state,
                "country" => $faker->country,
                "postcode" => $faker->postcode,
            ],
            "email" => $faker->email,
            "login" => [
                "uuid" => $faker->uuid,
                "username" => $faker->userName,
                "password" => $faker->password,
            ],
            "phone" => $faker->phoneNumber,
            "picture" => [
                "large" => "https://randomuser.me/api/portraits/" . ($faker->randomElement(['men','women'])) . "/" . rand(1,99) . ".jpg",
                "medium" => "https://randomuser.me/api/portraits/med/" . ($faker->randomElement(['men','women'])) . "/" . rand(1,99) . ".jpg",
                "thumbnail" => "https://randomuser.me/api/portraits/thumb/" . ($faker->randomElement(['men','women'])) . "/" . rand(1,99) . ".jpg",
            ]
        ];

        return response()->json([
            "results" => [$user],
            "info" => [
                "seed" => $faker->word,
                "results" => 1,
                "page" => 1,
                "version" => "1.0"
            ]
        ]);
    }
}
