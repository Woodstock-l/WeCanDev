<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller {
    public function index(Request $request) 
    {
        return $this->render('index.html.twig', array(
            'name' => 'Brigitte',
        ));
    }
}