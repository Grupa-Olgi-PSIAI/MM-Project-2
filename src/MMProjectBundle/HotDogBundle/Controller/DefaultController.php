<?php

namespace MMProjectBundle\HotDogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HotDogBundle:Default:index.html.twig');
    }
}
