<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // data 1
        $data0 = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52770');
        $json_data0 = json_decode($data0, true);
        $data0 = $json_data0['meals'][0];
        $meal0 = new Meal();
        $meal0
            ->setName($data0['strMeal'])
            ->setCategory($data0['strCategory'])
            ->setArea($data0['strArea'])
            ->setImage($data0['strMealThumb'])
            ->addInstruction($data0['strInstructions'])
        ;
        $manager->persist($meal0);

        // data 2
        $data1 = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52771');
        $json_data1 = json_decode($data1, true);
        $data1 = $json_data1['meals'][0];
        $meal1 = new Meal();
        $meal1
            ->setName($data1['strMeal'])
            ->setCategory($data1['strCategory'])
            ->setArea($data1['strArea'])
            ->setImage($data1['strMealThumb']);
        $manager->persist($meal1);

        // data 3
        $data2 = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52772');
        $json_data2 = json_decode($data2, true);
        $data2 = $json_data2['meals'][0];
        $meal2 = new Meal();
        $meal2
            ->setName($data2['strMeal'])
            ->setCategory($data2['strCategory'])
            ->setArea($data2['strArea'])
            ->setImage($data2['strMealThumb']);
        $manager->persist($meal2);

        // data 4
        $data3 = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52773');
        $json_data3 = json_decode($data3, true);
        $data3 = $json_data3['meals'][0];
        $meal3 = new Meal();
        $meal3
            ->setName($data3['strMeal'])
            ->setCategory($data3['strCategory'])
            ->setArea($data3['strArea'])
            ->setImage($data3['strMealThumb']);
        $manager->persist($meal3);

        // data 5
        $data4 = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52774');
        $json_data4 = json_decode($data4, true);
        $data4 = $json_data4['meals'][0];
        $meal4 = new Meal();
        $meal4
            ->setName($data4['strMeal'])
            ->setCategory($data4['strCategory'])
            ->setArea($data4['strArea'])
            ->setImage($data4['strMealThumb']);
        $manager->persist($meal4);

        // envoyer à la base de donée
        $manager->flush();
    }
}
