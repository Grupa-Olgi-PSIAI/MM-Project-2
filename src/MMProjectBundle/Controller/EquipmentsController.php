<?php

namespace MMProjectBundle\Controller;

use MMProjectBundle\Entity\Equipments;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Equipment controller.
 *
 * @Route("equipments")
 */
class EquipmentsController extends Controller
{
    /**
     * Lists all equipment entities.
     *
     * @Route("/", name="equipments_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipments = $em->getRepository('MMProjectBundle:Equipments')->findAll();

        return $this->render('equipments/index.html.twig', array(
            'equipments' => $equipments,
        ));
    }

    /**
     * Creates a new equipment entity.
     *
     * @Route("/new", name="equipments_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $equipment = new Equipments();
        $form = $this->createForm('MMProjectBundle\Form\EquipmentsType', $equipment);
        $form->handleRequest($request);
        $equipment->setVersion(1);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipment);
            $em->flush();

            return $this->redirectToRoute('equipments_show', array('id' => $equipment->getId()));
        }

        return $this->render('equipments/new.html.twig', array(
            'equipment' => $equipment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equipment entity.
     *
     * @Route("/{id}", name="equipments_show")
     * @Method("GET")
     */
    public function showAction(Equipments $equipment)
    {
        $deleteForm = $this->createDeleteForm($equipment);

        return $this->render('equipments/show.html.twig', array(
            'equipment' => $equipment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing equipment entity.
     *
     * @Route("/{id}/edit", name="equipments_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Equipments $equipment)
    {
        $deleteForm = $this->createDeleteForm($equipment);
        $editForm = $this->createForm('MMProjectBundle\Form\EquipmentsType', $equipment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipments_edit', array('id' => $equipment->getId()));
        }

        return $this->render('equipments/edit.html.twig', array(
            'equipment' => $equipment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a equipment entity.
     *
     * @Route("/{id}", name="equipments_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Equipments $equipment)
    {
        $form = $this->createDeleteForm($equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipment);
            $em->flush();
        }

        return $this->redirectToRoute('equipments_index');
    }

    /**
     * Creates a form to delete a equipment entity.
     *
     * @param Equipments $equipment The equipment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equipments $equipment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('equipments_delete', array('id' => $equipment->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
