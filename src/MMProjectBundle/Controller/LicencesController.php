<?php

namespace MMProjectBundle\Controller;

use MMProjectBundle\Entity\Licences;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Licence controller.
 *
 * @Route("licences")
 */
class LicencesController extends Controller
{
    /**
     * Lists all licence entities.
     *
     * @Route("/", name="licences_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $licences = $em->getRepository('MMProjectBundle:Licences')->findAll();

        return $this->render('licences/index.html.twig', array(
            'licences' => $licences,
        ));
    }

    /**
     * Creates a new licence entity.
     *
     * @Route("/new", name="licences_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $licence = new Licences();
        $form = $this->createForm('MMProjectBundle\Form\LicencesType', $licence);
        $form->handleRequest($request);
        $licence->setVersion(1);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($licence);
            $em->flush();

            return $this->redirectToRoute('licences_show', array('id' => $licence->getId()));
        }

        return $this->render('licences/new.html.twig', array(
            'licence' => $licence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a licence entity.
     *
     * @Route("/{id}", name="licences_show")
     * @Method("GET")
     */
    public function showAction(Licences $licence)
    {
        $deleteForm = $this->createDeleteForm($licence);

        return $this->render('licences/show.html.twig', array(
            'licence' => $licence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing licence entity.
     *
     * @Route("/{id}/edit", name="licences_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Licences $licence)
    {
        $deleteForm = $this->createDeleteForm($licence);
        $editForm = $this->createForm('MMProjectBundle\Form\LicencesType', $licence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('licences_edit', array('id' => $licence->getId()));
        }

        return $this->render('licences/edit.html.twig', array(
            'licence' => $licence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a licence entity.
     *
     * @Route("/{id}", name="licences_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Licences $licence)
    {
        $form = $this->createDeleteForm($licence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($licence);
            $em->flush();
        }

        return $this->redirectToRoute('licences_index');
    }

    /**
     * Creates a form to delete a licence entity.
     *
     * @param Licences $licence The licence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Licences $licence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('licences_delete', array('id' => $licence->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
