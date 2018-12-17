<?php 

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;

class ProfileFormType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'user.name',
            ))
            ->add('firstname', null, array(
                'label' => 'user.firstname',
            ))
            ->add('avatar', AvatarType::class, array(
                'label' => 'user.avatar',
            ))  
        ;
    }

    /**
     * Définit le formulaire parent
     */
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }
}