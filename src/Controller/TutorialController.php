<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

use App\Form\TutorialType;
use App\Entity\Tutorial;
use App\Entity\Rating;
use App\Entity\TutorialFollow;
use App\Entity\Comment;
use App\Form\CommentType;

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
    public function show(Tutorial $entity, Request $request) // $id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $af = null;

        if (is_object($user)) {
            $af = $em->getRepository(TutorialFollow::class)->findOneBy(array(
                'tutorial' => $entity,
                'user' =>$user,
            ));
        }
        
        $isFollow = is_object($af);

        $comment = new Comment();
        $comment->setUser($user);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setCreatedAt(new \DateTime())
                    ->setTutorial($entity);

            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('tutorial_show', ['id' => $entity->getId()]);
        }


        return $this->render('tutorial/show.html.twig', array(
            'entity' => $entity,

            'isFollow' => $isFollow,
            'commentForm' => $form->createView(),

        ));
    }

    /**
     * @Route("/follow/{id}", name="follow", requirements={"id" = "\d+"})
     */
    public function follow(Request $request, Tutorial $entity)
    {
        $isFollow = false;
        $user = $this->getUser();
        if (is_object($user)){
            $em = $this->getDoctrine()->getManager();
            $af = $em->getRepository(TutorialFollow::class)->findOneBy(array(
                'tutorial' => $entity,
                'user' =>$user,
            ));
            if ($af !== null){
                $em->remove($af);
            }
            else {
                $af = new TutorialFollow();
                $af->setTutorial($entity)->setUser($user);
                $em->persist($af);

                $isFollow = true;
            }
        }
    }
              
    /**
     * @Route("/rating/{id}", requirements={"id" = "\d+"}, name="rating")
     */
    public function rating(Request $request, Tutorial $entity)
    {
        $isRating = false;


        //Tester si l'utilisateur a déjà noté l'article
        $user = $this->getUser();
        $rating = $request->query->get('notesA');

        if (is_object($user))
        {
            $em = $this->getDoctrine()->getManager();
            $note = $em->getRepository(Rating::class)->findOneBy(array(
                'tutorials' => $entity,
                'user' =>$user,
            ));

            if ($note!== null){
                $note->setRating($rating);
                $em->persist($note);
            }
            else {
                $note = new Rating();
                $note->setTutorials($entity)->setUser($user)->setRating($rating);
                
                $em->persist($note);

                $isRating = true;
            }
            $entity->addUserRate($note);
            $entity->calculateAverage();
            $em->persist($entity);

            $em->flush();
            // Test si l'utilisateur à déjà noté
            // $note = repository()->find
        }

      if ($request->isXmlHttpRequest()) {
            return $this->json(array(
                'success' => true,
            ));
        }

        return $this->redirectToRoute('tutorial_show', array('id' => $entity->getId()));

    }

        
    public function recentTutorials($count = 5)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository(Tutorial::class)->findBy(['published' => true], ['id' => 'DESC'], $count);

        return $this->render('tutorial/_recent_tutorial.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * @Route("/pdf/{id}", name="pdf", requirements={"id" = "\d+"})
     */
    public function pdf(Request $request, Tutorial $entity)
        {
            $path = $request->server->get('DOCUMENT_ROOT');
            $path = rtrim($path, "/");

            $html = $this->renderView('tutorial/pdf.html.twig', array(
                'entity' => $entity,
                'path' => $path,
            ));
    
            return new PdfResponse(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html), 'tutorial.pdf'
            );
        }
}
