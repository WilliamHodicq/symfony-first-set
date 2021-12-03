<?php

namespace App\Controller;

use App\Entity\Property;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @Route("/biens", name="app_property.index")
     */
    public function index (EntityManagerInterface $entityManager){
        $property = new Property();
        $property->setPrice(200000)
            ->setRooms(4)
            ->setBedrooms(3)
            ->setTitle('Mon Premier Bien')
            ->setDescription('Une petite description')
            ->setSurface(60)
            ->setFloor(4)
            ->setHeat(1)
            ->setCity('Montpellier')
            ->setAdress('15 Boulevard gambetta')
            ->setPostalCode('34000')
            ->setSold(false);

        $em = $entityManager;
        $em->persist($property);
        $em->flush();
        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties'
        ]);
    }

}