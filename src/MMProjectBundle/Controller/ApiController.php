<?php

namespace MMProjectBundle\Controller;

use MMProjectBundle\Entity\Invoice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Api controller.
 *
 * @Route("api")
 */
class ApiController extends Controller
{
    /**
     * Lists amount of invoices per month
     *
     * @Route("/lpiskadlo", name="api_invoice_per_month")
     * @Method("GET")
     *
     * @return Response
     */
    public function getInvoicesPerMonthAction()
    {
        $em = $this->getDoctrine()->getManager();
        $invoices = $em->getRepository(Invoice::class)->findAll();

        $invoicesPerMonth = array();
        foreach ($invoices as $invoice) {
            $date = $invoice->getInvoiceDate()->format('Y-m');
            if (isset($invoicesPerMonth[$date])) {
                $amount = $invoicesPerMonth[$date] + 1;
            } else {
                $amount = 1;
            }
            $invoicesPerMonth[$date] = $amount;
        }

        $json = array();
        foreach ($invoicesPerMonth as $key => $value) {
            $json['invoices'][] = [
                'month' => $key,
                'amount' => $value,
            ];
        }
        return new JsonResponse($json);
    }


    /**
     * Lists amount of invoices in each currency
     *
     * @Route("/ochrostowska", name="api_invoices_in_currencies")
     * @Method("GET")
     *
     * @return Response
     */
    public function getInvoicesInCurrenciesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $invoices = $em->getRepository(Invoice::class)->findAll();

        $invoicesCurrencies = array();
        foreach ($invoices as $invoice) {
            $currency = $invoice->getCurrency();
            if (isset($invoicesCurrencies[$currency])) {
                $amount = $invoicesCurrencies[$currency] + 1;
            } else {
                $amount = 1;
            }
            $invoicesCurrencies[$currency] = $amount;
        }

        $json = array();
        foreach ($invoicesCurrencies as $key => $value) {
            $json['invoices'][] = [
                'currency' => $key,
                'amount' => $value,
            ];
        }
        return new JsonResponse($json);
    }

    /**
     * Hotdogs lists
     *
     * @Route("/pfrydrych", name="api_hotdogs")
     * @Method("GET")
     *
     * @return Response
     */
    public function getHotDogsAction()
    {
        $arr = array(
            [
                'name' => 'Ostry hotdog',
                'weight' => '300g',
                'price' => '6zl'
            ],
            [
                'name' => 'Łagodny hotdog',
                'weight' => '310g',
                'price' => '8zl'
            ],
            [
                'name' => 'Hotdog dla dzieci',
                'weight' => '150g',
                'price' => '6zl'
            ],
            [
                'name' => 'Piekielnie ostry hotdog',
                'weight' => '300g',
                'price' => '10zl'
            ],
            [
                'name' => 'Piecze trzy razy hotdog',
                'weight' => '300g',
                'price' => '13zl'
            ],
            [
                'name' => 'Farmerski hotdog',
                'weight' => '500g',
                'price' => '60zl'
            ],
            [
                'name' => 'Anielski hotdog',
                'weight' => '300g',
                'price' => '10zl'
            ],
            [
                'name' => 'Męski hotdog',
                'weight' => '1000g',
                'price' => '12zl'
            ],
            [
                'name' => 'Żeński hotdog',
                'weight' => '300g',
                'price' => '6zl'
            ]
        ,
            [
                'name' => 'Sportowy hotdog',
                'weight' => '600g',
                'price' => '16zl'
            ],
            [
                'name' => 'Informatyczny hotdog',
                'weight' => '300g',
                'price' => '6zl'
            ],
            [
                'name' => 'Miły hotdog',
                'weight' => '300g',
                'price' => '6zl'
            ]
        );

        return new JsonResponse($arr);
    }

    /**
     * shopping list
     *
     * @Route("/ppazura", name="api_shopping_list")
     * @Method("GET")
     *
     * @return Response
     */
    public function getShoppingListAction()
    {
        $shoppingList = array(
            [
                'name' => 'liść laurowy',
                'weight' => '10g',
                'price' => '1zl'
            ],
            [
                'name' => 'ziele angielskie',
                'weight' => '33g',
                'price' => '1zl'
            ],
            [
                'name' => 'główka czerwonej kapusty',
                'weight' => '910g',
                'price' => '12zl'
            ],
            [
                'name' => '100 g wędzonego boczku',
                'weight' => '100g',
                'price' => '5zl'
            ],
            [
                'name' => 'cebula',
                'weight' => '100g',
                'price' => '8zl'
            ],
            [
                'name' => 'ocet winny',
                'weight' => '100g',
                'price' => '8zl'
            ],
            [
                'name' => 'sól',
                'weight' => '5g',
                'price' => '1zl'
            ],
            [
                'name' => 'pieprz',
                'weight' => '5g',
                'price' => '1zl'
            ]

        );

        return new JsonResponse($shoppingList);
    }
}
