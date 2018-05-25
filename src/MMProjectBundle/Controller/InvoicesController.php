<?php

namespace MMProjectBundle\Controller;

use MMProjectBundle\Entity\Invoices;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Invoice controller.
 *
 * @Route("invoices")
 */
class InvoicesController extends Controller
{
    /**
     * Lists all invoice entities.
     *
     * @Route("/", name="invoices_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invoices = $em->getRepository('MMProjectBundle:Invoices')->findAll();

        return $this->render('invoices/index.html.twig', array(
            'invoices' => $invoices,
        ));
    }

    /**
     * Creates a new invoice entity.
     *
     * @Route("/new", name="invoices_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $invoice = new Invoices();
        $form = $this->createForm('MMProjectBundle\Form\InvoicesType', $invoice);
        $form->handleRequest($request);
        $invoice->setVersion(1);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush();

            return $this->redirectToRoute('invoices_show', array('id' => $invoice->getId()));
        }

        return $this->render('invoices/new.html.twig', array(
            'invoice' => $invoice,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invoice entity.
     *
     * @Route("/{id}", name="invoices_show")
     * @Method("GET")
     */
    public function showAction(Invoices $invoice)
    {
        $deleteForm = $this->createDeleteForm($invoice);

        return $this->render('invoices/show.html.twig', array(
            'invoice' => $invoice,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invoice entity.
     *
     * @Route("/{id}/edit", name="invoices_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Invoices $invoice)
    {
        $deleteForm = $this->createDeleteForm($invoice);
        $editForm = $this->createForm('MMProjectBundle\Form\InvoicesType', $invoice);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invoices_edit', array('id' => $invoice->getId()));
        }

        return $this->render('invoices/edit.html.twig', array(
            'invoice' => $invoice,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invoice entity.
     *
     * @Route("/{id}", name="invoices_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Invoices $invoice)
    {
        $form = $this->createDeleteForm($invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invoice);
            $em->flush();
        }

        return $this->redirectToRoute('invoices_index');
    }

    /**
     * Creates a form to delete a invoice entity.
     *
     * @param Invoices $invoice The invoice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Invoices $invoice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invoices_delete', array('id' => $invoice->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
