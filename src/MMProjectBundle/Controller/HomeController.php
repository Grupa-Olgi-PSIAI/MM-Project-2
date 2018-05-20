<?php


namespace MMProjectBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/home")
     */
    public function homeAction()
    {
        return new Response(
            '<html><body><h1>Hello world!</h1></body></html>'
        );
    }
}
