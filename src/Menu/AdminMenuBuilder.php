<?php 

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class AdminMenuBuilder
{
    private $factory;
    private $tokenStorage;

    public function __construct(FactoryInterface $factory, TokenStorage $tokenStorage)
    {
        $this->factory = $factory;
        $this->tokenStorage = $tokenStorage;
    }

    public function createMenu()
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $menu = $this->factory->createItem('root');

        if (is_object($user) && $user->hasRole('ROLE_SUPER_ADMIN')) 
        {
            // Création du menu tutorial
            $parent = $menu->addChild('menu.admin.tutorial', ['uri' => '#']);
            // Ajoute un sous-menu
            $parent->addChild('menu.admin.tutorial_list', ['route' => 'admin_tutorial_index']);
            $parent->addChild('menu.admin.tutorial_new', ['route' => 'admin_tutorial_new']);
    
            // Création du menu category
            $parent = $menu->addChild('menu.admin.category', ['uri' => '#']);
            // Ajoute un sous-menu
            $parent->addChild('menu.admin.category_list', ['route' => 'admin_category_index']);
            $parent->addChild('menu.admin.category_new', ['route' => 'admin_category_new']);
    
            // Création du menu category
            $parent = $menu->addChild('menu.admin.users', ['uri' => '#']);
            // Ajoute un sous-menu
            $parent->addChild('menu.admin.users_list', ['route' => 'admin_user_index']);
            $parent->addChild('menu.admin.users_new', ['route' => 'admin_user_new']);
    
            return $menu;
        }
        else
        {
            // Création du menu tutorial
            $parent = $menu->addChild('menu.admin.tutorial_new', ['route' => 'admin_tutorial_new']);

            return $menu;
        }
    }
}