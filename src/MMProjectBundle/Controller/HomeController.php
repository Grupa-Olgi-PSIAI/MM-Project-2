<?php


namespace MMProjectBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController
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
