<?php

namespace App\Controller;

use App\Entity\Meal;
use App\Form\MealType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MealController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/meal/{id}", name="meal_single", requirements={"id"="\d+"})
     */
    public function single(Meal $meal): Response
    {
        return $this->render('meal/single.html.twig', [
            'meal' => $meal,
        ]);
    }

    /**
     * @Route("/meal/{id}/update", name="meal_update", requirements={"id"="\d+"})
     */
    public function updateForm(Meal $meal, Request $request): Response
    {
        $form = $this->createForm(MealType::class, $meal);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addFlash('success', 'Meal successfully updated .');
            return $this->redirectToRoute('main_management');
        }
        return $this->render('meal/update.html.twig', [
            'meal' => $meal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/meal/create", name="meal_create")
     */
    public function newForm(Request $request): Response
    {
        $meal = new Meal();
        $form = $this->createForm(MealType::class, $meal);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($meal);
            $this->entityManager->flush();
            $this->addFlash('success', 'Meal successfully created .');
            return $this->redirectToRoute('main_management');
        }
        return $this->render('meal/create.html.twig', [
            'meal' => $meal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/meal/{id}/delete", name="meal_delete", methods={"POST"})
     */
    public function delete(Meal $meal): Response
    {
        $this->entityManager->remove($meal);
        $this->entityManager->flush();
        $this->addFlash('success', 'Meal successfully deleted .');
        return $this->redirectToRoute('main_management');
    }


}
