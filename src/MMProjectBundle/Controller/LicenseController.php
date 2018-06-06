<?php

namespace MMProjectBundle\Controller;

use MMProjectBundle\Entity\License;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * License controller.
 *
 * @Route("license")
 */
class LicenseController extends Controller
{
    /**
     * Lists all license entities.
     *
     * @Route("/", name="license_index")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ALLOWED_VIEW_LICENSE')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $licenses = $em->getRepository(License::class)->queryAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $licenses,
            $request->query->getInt('page', 1),
            $this->getParameter('items_per_page'));

        return $this->render('license/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new license entity.
     *
     * @Route("/new", name="license_new")
     * @Method({"GET", "POST"})
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_LICENSE')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $license = new License();
        $form = $this->createForm('MMProjectBundle\Form\LicenseType', $license);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($license);
            $em->flush();

            return $this->redirectToRoute('license_show', array('id' => $license->getId()));
        }

        return $this->render('license/new.html.twig', array(
            'license' => $license,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a license entity.
     *
     * @Route("/{id}", name="license_show")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ALLOWED_VIEW_LICENSE')")
     *
     * @param License $license
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(License $license)
    {
        $deleteForm = $this->createDeleteForm($license);

        return $this->render('license/show.html.twig', array(
            'license' => $license,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing license entity.
     *
     * @Route("/{id}/edit", name="license_edit")
     * @Method({"GET", "POST"})
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_LICENSE')")
     *
     * @param Request $request
     * @param License $license
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, License $license)
    {
        $deleteForm = $this->createDeleteForm($license);
        $fileUrl = $this->generateUrl('license_download', ['id' => $license->getId()]);
        $editForm = $this->createForm('MMProjectBundle\Form\LicenseType', $license, ['fileUrl' => $fileUrl]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('license_edit', array('id' => $license->getId()));
        }

        return $this->render('license/edit.html.twig', array(
            'license' => $license,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a license entity.
     *
     * @Route("/{id}", name="license_delete")
     * @Method("DELETE")
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_LICENSE')")
     *
     * @param Request $request
     * @param License $license
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, License $license)
    {
        $form = $this->createDeleteForm($license);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($license);
            $em->flush();
        }

        return $this->redirectToRoute('license_index');
    }

    /**
     * Downloads a license
     *
     * @Route("/{id}/download", name="license_download")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ALLOWED_VIEW_LICENSE')")
     *
     * @param License $license
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFileAction(License $license)
    {
        $downloadHandler = $this->get('vich_uploader.download_handler');
        return $downloadHandler->downloadObject($license, $fileField = 'file', $objectClass = null, true);
    }

    /**
     * Creates a form to delete a license entity.
     *
     * @param License $license The license entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(License $license)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('license_delete', array('id' => $license->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
