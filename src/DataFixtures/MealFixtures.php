<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Instruction;
use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MealFixtures extends Fixture
{
    protected function makeMeal(string $name, string $category, string $area, string $image): Meal
    {
        $meal = new Meal();
        $meal
            ->setName($name)
            ->setCategory($category)
            ->setArea($area)
            ->setImage($image);

        return $meal;
    }

    protected function makeInstruction(string $description, int $instructionRank, Meal $meal): Instruction
    {
        $instruction = new Instruction();
        $instruction
            ->setDescription($description)
            ->setInstructionRank($instructionRank)
            ->setMeal($meal);

        return $instruction;
    }

    protected function makeIngredient(string $name, string $measure, Meal $meal): Ingredient
    {
        $ingredient = new Ingredient();
        $ingredient
            ->setName($name)
            ->setMeasure($measure)
            ->setMeal($meal);

        return $ingredient;
    }

    public function load(ObjectManager $manager)
    {
        // data 1
        $data0 = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52770');
        $json_data0 = json_decode($data0, true);
        $data0 = $json_data0['meals'][0];
        // data 2
        $data1 = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52771');
        $json_data1 = json_decode($data1, true);
        $data1 = $json_data1['meals'][0];
        // data 3
        $data2 = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52772');
        $json_data2 = json_decode($data2, true);
        $data2 = $json_data2['meals'][0];
        // data 4
        $data3 = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52773');
        $json_data3 = json_decode($data3, true);
        $data3 = $json_data3['meals'][0];
        // data 5
        $data4 = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52774');
        $json_data4 = json_decode($data4, true);
        $data4 = $json_data4['meals'][0];

        //----------------------------------------------------

        // Crée les meals
        $meals = [
            $this->makeMeal($data0['strMeal'], $data0['strCategory'], $data0['strArea'], $data0['strMealThumb']),
            $this->makeMeal($data1['strMeal'], $data1['strCategory'], $data1['strArea'], $data1['strMealThumb']),
            $this->makeMeal($data2['strMeal'], $data2['strCategory'], $data2['strArea'], $data2['strMealThumb']),
            $this->makeMeal($data3['strMeal'], $data3['strCategory'], $data3['strArea'], $data3['strMealThumb']),
            $this->makeMeal($data4['strMeal'], $data4['strCategory'], $data4['strArea'], $data4['strMealThumb']),
        ];

        //----------------------------------------------------

        // Crée les instructions
        $dataInstructions0 = explode("\r\n", $data0['strInstructions']);
        $instructions = [];
        foreach ($dataInstructions0 as $k => $instruction) {
            $result = $this->makeInstruction($instruction, $k + 1, $meals[0]);
            $instructions[] = $result;
        }
        $dataInstructions1 = explode("\r\n", $data1['strInstructions']);
        foreach ($dataInstructions1 as $k => $instruction) {
            $result = $this->makeInstruction($instruction, $k + 1, $meals[1]);
            $instructions[] = $result;
        }
        $dataInstructions2 = explode("\r\n", $data2['strInstructions']);
        foreach ($dataInstructions2 as $k => $instruction) {
            $result = $this->makeInstruction($instruction, $k + 1, $meals[2]);
            $instructions[] = $result;
        }
        $dataInstructions3 = explode("\r\n", $data3['strInstructions']);
        foreach ($dataInstructions3 as $k => $instruction) {
            $result = $this->makeInstruction($instruction, $k + 1, $meals[3]);
            $instructions[] = $result;
        }
        $dataInstructions4 = explode("\r\n", $data4['strInstructions']);
        foreach ($dataInstructions4 as $k => $instruction) {
            $result = $this->makeInstruction($instruction, $k + 1, $meals[4]);
            $instructions[] = $result;
        };

        //----------------------------------------------------

        // Crée les ingredients
        $ingredients = [];
        for ($i = 1; $i <= 12; $i ++) {
            $result = $this->makeIngredient($data0['strIngredient' . $i], $data0['strMeasure' . $i], $meals[0]);
            $ingredients[] = $result;
        }
        for ($i = 1; $i <= 8; $i++) {
            $result = $this->makeIngredient($data1['strIngredient' . $i], $data1['strMeasure' . $i], $meals[1]);
            $ingredients[] = $result;
        }
        for ($i = 1; $i <= 9; $i++) {
            $result = $this->makeIngredient($data2['strIngredient' . $i], $data2['strMeasure' . $i], $meals[2]);
            $ingredients[] = $result;
        }
        for ($i = 1; $i <= 5; $i++) {
            $result = $this->makeIngredient($data3['strIngredient' . $i], $data3['strMeasure' . $i], $meals[3]);
            $ingredients[] = $result;
        }
        for ($i = 1; $i <= 12; $i++) {
            $result = $this->makeIngredient($data4['strIngredient' . $i], $data4['strMeasure' . $i], $meals[4]);
            $ingredients[] = $result;
        };

        //----------------------------------------------------

        // Marque tous les objets créés comme prêts à être envoyés en base de données
        foreach (\array_merge($meals, $instructions, $ingredients) as $object) {
            $manager->persist($object);
        }

        // envoyer à la base de donée
        $manager->flush();
    }
}