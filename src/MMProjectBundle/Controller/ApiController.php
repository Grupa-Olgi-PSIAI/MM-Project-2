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

        return new JsonResponse($arr);
    }
}
