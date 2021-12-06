<?php

namespace App\Controller;


use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends  AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function homepage(PropertyRepository $repository): Response
    {
        $properties = $repository->findLatest();
        return $this->render('pages/home.html.twig', [
            'current_menu' => 'home',
            'properties' => $properties,
        ]);
    }
}