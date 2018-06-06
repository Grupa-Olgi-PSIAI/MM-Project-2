<?php

namespace MMProjectBundle\Controller;

use MMProjectBundle\Entity\Document;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Document controller.
 *
 * @Route("document")
 */
class DocumentController extends Controller
{
    /**
     * Lists all document entities.
     *
     * @Route("/", name="document_index")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ALLOWED_VIEW_DOCUMENT')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $documents = $em->getRepository(Document::class)->queryAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $documents,
            $request->query->getInt('page', 1),
            $this->getParameter('items_per_page'));

        return $this->render('document/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    public function queryBy($attribute_name, $attribute_value, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $documents = $em->getRepository(Document::class)->findBy(
            [$attribute_name => $attribute_value]
        );

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $documents,
            $request->query->getInt('page', 1),
            $this->getParameter('items_per_page'));

        return $this->render('document/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new document entity.
     *
     * @Route("/new", name="document_new")
     * @Method({"GET", "POST"})
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_DOCUMENT')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $document = new Document();
        $form = $this->createForm('MMProjectBundle\Form\DocumentType', $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('document_show', array('id' => $document->getId()));
        }

        return $this->render('document/new.html.twig', array(
            'document' => $document,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a document entity.
     *
     * @Route("/{id}", name="document_show")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ALLOWED_VIEW_DOCUMENT')")
     *
     * @param Document $document
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Document $document)
    {
        $deleteForm = $this->createDeleteForm($document);

        return $this->render('document/show.html.twig', array(
            'document' => $document,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing document entity.
     *
     * @Route("/{id}/edit", name="document_edit")
     * @Method({"GET", "POST"})
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_DOCUMENT')")
     *
     * @param Request $request
     * @param Document $document
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Document $document)
    {
        $deleteForm = $this->createDeleteForm($document);
        $fileUrl = $this->generateUrl('document_download', ['id' => $document->getId()]);
        $editForm = $this->createForm('MMProjectBundle\Form\DocumentType', $document, ['fileUrl' => $fileUrl]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('document_edit', array('id' => $document->getId()));
        }

        return $this->render('document/edit.html.twig', array(
            'document' => $document,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a document entity.
     *
     * @Route("/{id}", name="document_delete")
     * @Method("DELETE")
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_DOCUMENT')")
     *
     * @param Request $request
     * @param Document $document
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Document $document)
    {
        $form = $this->createDeleteForm($document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($document);
            $em->flush();
        }

        return $this->redirectToRoute('document_index');
    }

    /**
     * Downloads a document
     *
     * @Route("/{id}/download", name="document_download")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ALLOWED_VIEW_DOCUMENT')")
     *
     * @param Document $document
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFileAction(Document $document)
    {
        $downloadHandler = $this->get('vich_uploader.download_handler');
        return $downloadHandler->downloadObject($document, $fileField = 'file', $objectClass = null, true);
    }

    /**
     * Creates a form to delete a document entity.
     *
     * @param Document $document The document entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Document $document)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('document_delete', array('id' => $document->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
