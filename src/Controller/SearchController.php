<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index()
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    public function searchBar(){
        $form = $this->createFormBuilder()
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => array(
                    'name' => 'saisie',
                    'placeholder' => 'Recherche...',)
            ])
            ->add('search', SubmitType::class, [
                'label' => false,
                'attr' => array(
                    'class' => 'loupe',
                    'placeholder' => ' ',)                    
            ])
            ->getForm();

        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function resultSearch($value)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository(Tutorial::class)->findBySearch($value);

        return $this->render('search/index.html.twig', array(
            'entities' => $entities,
        ));
    }
}
