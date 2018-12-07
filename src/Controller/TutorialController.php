<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\TutorialType;
use App\Entity\Tutorial;
// use App\Entity\TutorialFollow;


/**
 * @Route("/tutorial", name="tutorial_")
 */
class TutorialController extends Controller
{
    /**
     * @Route("/{page}", requirements={"page" = "\d+"}, defaults={"page" = 1}, name="index")
     */
    public function index($page)
    {
        $em = $this->getDoctrine()->getManager();
        $count = 3; 
        $user = $this->getUser();
        $isPublished = true;
        if (is_object($user) && $user->hasRole('ROLE_SUPER_ADMIN')) {
            $isPublished = null;
        }
        $entities = $em->getRepository(Tutorial::class)->findByPage($page, $count, $isPublished); 
        $nbPages = ceil(count($entities) / $count);

        return $this->render('tutorial/index.html.twig', array(
            'entities' => $entities,
            'nbPages' => $nbPages,
            'page' => $page,
            'count' => count($entities),
            ));
    }

    /**
     * @Route("/show/{id}", name="show", requirements={"id" = "\d+"})
     */
    public function show(Tutorial $entity) // $id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        // $af = $em->getRepository(Follow::class)->findOneBy(array(
        //     'article' => $entity,
        //     'user' =>$user,
        // ));
        // $isFollow = is_object($af);

        return $this->render('tutorial/show.html.twig', array(
            'entity' => $entity,
            // 'isFollow' => $isFollow,
        ));
    }

    /**
     * @Route("/follow/{id}", name="follow", requirements={"id" = "\d+"})
     */
    // public function follow(Request $request, Tutorial $entity)
    // {
    //     $isFollow = false;
    //     $user = $this->getUser();
    //     if (is_object($user)){
    //         $em = $this->getDoctrine()->getManager();
    //         $af = $em->getRepository(TutorialFollow::class)->findOneBy(array(
    //             'article' => $entity,
    //             'user' =>$user,
    //         ));
    //         if ($af !== null){
    //             $em->remove($af);
    //         }
    //         else {
    //             $af = new TutorialFollow();
    //             $af->setTutorial($entity)->setUser($user);
    //             $em->persist($af);

    //             $isFollow = true;
    //         }

    //         $em->flush();
    //     }

    //     if ($request->isXmlHttpRequest()) {
    //         return $this->json(array(
    //             'success' => true,
    //             'isFollow' => $isFollow,
    //         ));
    //     }

    //     return $this->redirectToRoute('tutorial_show', array('id' => $entity->getId()));
    // }    
        
    public function recentTutorials($count = 5)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository(Tutorial::class)->findBy(['publication' => true], ['id' => 'DESC'], $count);

        return $this->render('tutorial/_recent_tutorials.html.twig', array(
            'entities' => $entities,
        ));
    }
}