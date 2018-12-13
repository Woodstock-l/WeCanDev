<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Translation\TranslatorInterface;

class RegistrationListener
{
    private $session;
    private $translator;

    public function __construct(SessionInterface $session, TranslatorInterface $translator)
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    public function onRegistrationConfirm($event)
    {
        //$this->session->getFlashBag()->add('success', $this->translator->trans('register.success'));
        //Possibilité d'envoyer un mail avec cette fonction
    }
}

