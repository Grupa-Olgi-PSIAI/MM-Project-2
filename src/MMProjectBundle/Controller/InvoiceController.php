<?php

namespace MMProjectBundle\Controller;

use MMProjectBundle\Entity\Invoice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Invoice controller.
 *
 * @Route("invoice")
 */
class InvoiceController extends Controller
{
    /**
     * Lists all invoice entities.
     *
     * @Route("/", name="invoice_index")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ALLOWED_VIEW_INVOICE')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $invoices = $em->getRepository(Invoice::class)->queryAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $invoices,
            $request->query->getInt('page', 1),
            $this->getParameter('items_per_page'));

        return $this->render('invoice/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new invoice entity.
     *
     * @Route("/new", name="invoice_new")
     * @Method({"GET", "POST"})
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_INVOICE')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $invoice = new Invoice();
        $form = $this->createForm('MMProjectBundle\Form\InvoiceType', $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush();

            return $this->redirectToRoute('invoice_show', array('id' => $invoice->getId()));
        }

        return $this->render('invoice/new.html.twig', array(
            'invoice' => $invoice,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invoice entity.
     *
     * @Route("/{id}", name="invoice_show")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ALLOWED_VIEW_INVOICE')")
     *
     * @param Invoice $invoice
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Invoice $invoice)
    {
        $deleteForm = $this->createDeleteForm($invoice);

        return $this->render('invoice/show.html.twig', array(
            'invoice' => $invoice,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invoice entity.
     *
     * @Route("/{id}/edit", name="invoice_edit")
     * @Method({"GET", "POST"})
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_INVOICE')")
     *
     * @param Request $request
     * @param Invoice $invoice
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Invoice $invoice)
    {
        $deleteForm = $this->createDeleteForm($invoice);
        $fileUrl = $this->generateUrl('invoice_download', ['id' => $invoice->getId()]);
        $editForm = $this->createForm('MMProjectBundle\Form\InvoiceType', $invoice, ['fileUrl' => $fileUrl]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invoice_edit', array('id' => $invoice->getId()));
        }

        return $this->render('invoice/edit.html.twig', array(
            'invoice' => $invoice,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invoice entity.
     *
     * @Route("/{id}", name="invoice_delete")
     * @Method("DELETE")
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_INVOICE')")
     *
     * @param Request $request
     * @param Invoice $invoice
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Invoice $invoice)
    {
        $form = $this->createDeleteForm($invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invoice);
            $em->flush();
        }

        return $this->redirectToRoute('invoice_index');
    }

    /**
     * Downloads an invoice
     *
     * @Route("/{id}/download", name="invoice_download")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ALLOWED_VIEW_INVOICE')")
     *
     * @param Invoice $invoice
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFileAction(Invoice $invoice)
    {
        $downloadHandler = $this->get('vich_uploader.download_handler');
        return $downloadHandler->downloadObject($invoice, $fileField = 'file', $objectClass = null, true);
    }

    /**
     * Creates a form to delete a invoice entity.
     *
     * @param Invoice $invoice The invoice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Invoice $invoice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invoice_delete', array('id' => $invoice->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
