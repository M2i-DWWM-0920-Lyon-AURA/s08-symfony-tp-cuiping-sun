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
        $meals = $Meal->findAll();
        return $this->render('main/index.html.twig', [
            'meals' => $meals,
        ]);
    }
}
