<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/profile/{username}", name="profile", defaults={"username" = null})
     */
    public function profile($username = null)
    {
        if (is_null($username)) {
            $entity = $this->getUser();
        } else {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository(User::class)->findOneByUsername($username);
        }
        
        return $this->render('/user/profile.html.twig', array(
            'entity' => $entity,
        ));
    }


    /**
     * @Route("/follow/{id}", requirements={"id" = "\d+"}, name="follow")
     */
    public function connect(Request $request)
    {
        // Test si la requêteenvoyé est en AJAX
        if ($request->isXmlHttpRequest())
        {
            //return new JsonResponse(array());
            return $this->json(array(
                'success' => true,
            ));
        }
    }
}
