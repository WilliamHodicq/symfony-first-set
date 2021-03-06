<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController{

    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $repository,EntityManagerInterface $em){

        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route ("/admin" , name="app_admin.property.index")
     * @return Response
     */
    public function index ():Response
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig',compact('properties'));
    }

    /**
     * @route ("/admin/property/create", name="app_admin.property.new")
     */
    public function new(Request $request){

        $property = new Property();
        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($property);
            $this->em->flush();

            $this->addFlash('success','Ce bien a été créer avec succès');
            return $this->redirectToRoute('app_admin.property.index');
        }

        return $this->render('admin/property/new.html.twig',[
            'property' =>$property,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route ("/admin/property/{id}" , name="app_admin.property.edit",methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function edit(Property $property,Request $request):Response{

        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','Ce bien a été modifier avec succès');
            return $this->redirectToRoute('app_admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig',[
            'property' =>$property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/property/{id}" , name="app_admin.property.delete", methods="DELETE")
     * @param Property $property
     * @return Response
     */
    public function delete(Property $property, Request $request){
        if ($this->isCsrfTokenValid('delete'. $property->getId(),$request->get('_token'))){
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success','Ce bien a été supprimer');
        }
        return $this->redirectToRoute('app_admin.property.index');
    }


}