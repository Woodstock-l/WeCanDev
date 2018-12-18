<?php 

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;

class RegistrationType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
            'label' => 'register.name',
            ))
            ->add('firstname', null, array(
            'label' => 'register.firstname',
            ))
            ->add('policy', Type\CheckboxType::class, array(
                'label' => 'registration.policy',
                'required' => true,
                'mapped' => false, // Ce champ n'est pas dans l'entité User (pas d'enregistrement en db)
            ))
        ;
    }

    /**
     * Définit le formulaire parent
     */
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}