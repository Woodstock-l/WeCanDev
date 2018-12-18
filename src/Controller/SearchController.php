<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Tutorial;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function searchBar(Request $request){
        $form = $this->createFormBuilder()

            ->setAction($this->generateUrl('search'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => array(
                    'name' => 'saisie',
                    'placeholder' => 'Recherche...',
                    'autocomplete'=> 'off',)
            ])
            ->add('search', SubmitType::class, [
                'label' => false,
                'attr' => array(
                    'class' => 'loupe',
                    'placeholder' => ' ',)                    
            ])
            ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $data = $form->getData();
                $tutorials = $em->getRepository(Tutorial::class)->findBySearch($data['query']);
                
                if ($form->get('search')->isClicked()) {
                    return $this->render('search/index.html.twig', ['tutorials' => $tutorials]);
                }
                $results = [];
                $result = [];
                
                if (!is_null($tutorials)) {
                  foreach ($tutorials as $tutorial) {

                    $categories = [];

                    foreach($tutorial->getCategories() as $cat) {
                        $categories[] = array(
                            'id' => $cat->getId(),
                            'name' => $cat->getName(),
                        );
                    }

                    $result = [
                        'title' => $tutorial->getTitle(),
                        'category' => $categories,
                        'url' => $this->generateUrl('tutorial_show', ['id' => $tutorial->getId()])
                    ];
                    
                    array_push($results, $result); 
                }
                
                }
                return $this->json(
                    $results
                );  
                
            }
            
            return $this->render('search/searchBar.html.twig',[
                'form' => $form->createView()
            ]); 
    
    }

}
