<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

use App\Form\TutorialType;
use App\Entity\Tutorial;

/**
 * @Route("/admin/tutorial", name="admin_tutorial_")
 */
class TutorialController extends Controller
{
    /**
     * @Route("/{page}", name="index", requirements={"page" = "\d+"}, defaults={"page" = 1})
     */
    public function index($page)
    {
        $count = 20;
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository(Tutorial::class)->findByPage($page, $count);
        $nbPages = ceil(count($entities) / $count);

        return $this->render('admin/tutorial/index.html.twig', array(
            'entities' => $entities,
            'page' => $page,
            'nbPages' => $nbPages,
        ));
    }
    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request, EventDispatcherInterface $eventDispatcher)
    {
        $entity = new Tutorial;
        $user = $this->getUser();
        $entity->setUser($user);
        
        $form = $this->createForm(TutorialType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $t = $this->get('translator');
            $this->addFlash('success', $t->trans('tutorial.new.success'));

            $event = new GenericEvent($entity);
            $eventDispatcher->dispatch('tutorial.add', $event);

            return $this->redirectToRoute('admin_tutorial_index');
        }

        return $this->render('admin/tutorial/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id" = "\d+"})
     */
    public function edit(Request $request, Tutorial $entity) {
        $form = $this->createForm(TutorialType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $t = $this->get('translator');
            $this->addFlash('success', $t->trans('tutorial.edit.success'));

            return $this->redirectToRoute('admin_tutorial_index'); 
        }

        return $this->render('admin/tutorial/new.html.twig', array(
            'form' => $form->createView(),
            'entity' => $entity
        ));
    }

    /**
     * @Route("/delete/{id}", name="delete", requirements={"id" = "\d+"})
     */
    public function delete(Request $request, Tutorial $entity){
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_tutorial_delete', ['id' => $entity->getId()]))
            ->setMethod('DELETE')
            ->getForm()
            ;

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();

            $t = $this->get('translator');
            $this->addFlash('success', $t->trans('tutorial.delete.success'));


            return $this->redirectToRoute('admin_tutorial_index');
        }
        
        return $this->render('admin/tutorial/delete.html.twig', array(
            'form' => $form->createView(),
            'entity' => $entity
        ));
    }
}