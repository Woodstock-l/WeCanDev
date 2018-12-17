<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
    public function index(Request $request) 
    {
        return $this->render('index.html.twig', array(
            'name' => 'Brigitte',
        ));
    }

    // public function searchAction(){
    //     $request = $this->getRequest();
    //     $data = $request->request->get('search');
     
     
    //     $em = $this->getDoctrine()->getManager();
    //     $query = $em->createQuery(
    //      'SELECT p FROM FooTransBundle:Suplier p
    //      WHERE p.name LIKE :data')
    //     ->setParameter('data',$data);
     
     
    //  $res = $query->getResult();
     
    //  return $this->render('FooTransBundle:Default:search.html.twig', array(
    //      'res' => $res));
    // }
}