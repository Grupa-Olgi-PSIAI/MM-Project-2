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
}
