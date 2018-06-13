<?php

namespace MMProjectBundle\HotDogBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class ApiController extends FOSRestController
{
    public function optionsHotDogAction()
    {
    }

    public function getHotDogsAction()
    {
        $arr = array(
            [
                'Name' => 'Ostry hotdog',
                'Weight' => '300g',
                'Price' => '6zl'
            ],
            [
                'Name' => 'Łagodny hotdog',
                'Weight' => '310g',
                'Price' => '8zl'
            ],
            [
                'Name' => 'Hotdog dla dzieci',
                'Weight' => '150g',
                'Price' => '6zl'
            ],
            [
                'Name' => 'Piekielnie ostry hotdog',
                'Weight' => '300g',
                'Price' => '10zl'
            ],
            [
                'Name' => 'Piecze trzy razy hotdog',
                'Weight' => '300g',
                'Price' => '13zl'
            ],
            [
                'Name' => 'Farmerski hotdog',
                'Weight' => '500g',
                'Price' => '60zl'
            ],
            [
                'Name' => 'Anielski hotdog',
                'Weight' => '300g',
                'Price' => '10zl'
            ],
            [
                'Name' => 'Męski hotdog',
                'Weight' => '1000g',
                'Price' => '12zl'
            ],
            [
                'Name' => 'Żeński hotdog',
                'Weight' => '300g',
                'Price' => '6zl'
            ]
            ,
            [
                'Name' => 'Sportowy hotdog',
                'Weight' => '600g',
                'Price' => '16zl'
            ],
            [
                'Name' => 'Informatyczny hotdog',
                'Weight' => '300g',
                'Price' => '6zl'
            ],
            [
                'Name' => 'Miły hotdog',
                'Weight' => '300g',
                'Price' => '6zl'
            ]
        );

        $view = $this->view($arr, 200);
        return $this->handleView($view);
    }
}