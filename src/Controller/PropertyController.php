<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\ContactType;
use App\Form\PropertySearchType;
use App\Notification\ContactNotification;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="app_property.index")
     * @return Response
     */
    public function index (PaginatorInterface $paginator,Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$search);
        $form->handleRequest($request);

        $properties = $paginator->paginate($this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),12);
        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties',
            'properties' => $properties,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/biens/{id}", name="app_property.show" )
     * @param $id
     * @return Response
     */
    public function show(Property $property,Request $request, ContactNotification $notification):Response{
        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class,$contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $notification->notify($contact);

            $this->addFlash('success', 'votre email a bien été envoyé');

            return $this->redirectToRoute('app_property.show',[
                'id' => $property->getId(),
            ]);
        }
        return $this->render('property/show.html.twig',[
            'property'=> $property,
            'current_menu' => 'properties',
            'form'=> $form->createView(),
        ]);

    }



}