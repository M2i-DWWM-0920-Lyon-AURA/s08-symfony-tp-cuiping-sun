<?php

namespace App\Controller;

use App\Entity\Meal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MealController extends AbstractController
{
    /**
     * @Route("/meal/{id}", name="meal_single", requirements={"id"="\d+"})
     */
    public function single(Meal $meal): Response
    {
        return $this->render('meal/single.html.twig', [
            'meal' => $meal,
        ]);
    }
}
