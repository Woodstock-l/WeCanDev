<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

use App\Form\Tutorial;
use App\Form\ImageType;

class TutorialType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title', null, array(
                'label' => 'tutorial.title',
            ))
            ->add('categories', null, array(
                'label' => 'tutorial.categories',
                'expanded' => true,
                'query_builder' => function(EntityRepository $er) {
                   return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                }
            ))
            ->add('image', ImageType::class, array(
                'label' => 'tutorial.image',
            )) 
            ->add('content', null, array(
                'label' => 'tutorial.content',
                'attr' => [
                    'class' => 'summernote'
                ]
            ))
            ->add('published', null, array(
            'label' => 'tutorial.published'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data' => Tutorial::class,
        ]);
    }
}