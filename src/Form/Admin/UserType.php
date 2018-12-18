<?php

namespace App\Form\Admin;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserType extends AbstractType
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $roles = array(
            'role.contributor' => 'ROLE_CONTRIBUTOR',
            'role.user' => 'ROLE_USER',
        );

        $user = $this->tokenStorage->getToken()->getUser(); // Utilisateur connecté
        if (is_object($user) && $user->hasRole('ROLE_SUPER_ADMIN')) {
            $roles['role.super_admin'] = 'ROLE_SUPER_ADMIN';
        }

        $builder
            ->add('username', null, array('label' => 'Pseudo'))
            ->add('email')
            ->add('enabled', null, array('label' => 'Compte activé/desactivé'))
            ->add('plainPassword', null, array('label' => 'Mot de passe'))
            ->add('roles', Type\ChoiceType::class, array(
                'multiple' => true,
                'choices' => $roles
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
