<?php

namespace App\Controller;

use App\Repository\MealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(MealRepository $Meal): Response
    {
        /* $data0 = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52770');
        $json_data0 = json_decode($data0, true);
        $data0 = $json_data0['meals'][0];
        dd($data0); */
        $meals = $Meal->findAll();
        return $this->render('main/index.html.twig', [
            'meals' => $meals,
        ]);
    }
}
