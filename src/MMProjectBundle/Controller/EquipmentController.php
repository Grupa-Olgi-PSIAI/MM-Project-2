<?php

namespace MMProjectBundle\Controller;

use MMProjectBundle\Entity\Equipment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Equipment controller.
 *
 * @Route("equipment")
 */
class EquipmentController extends Controller
{
    /**
     * Lists all equipment entities.
     *
     * @Route("/", name="equipment_index")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ALLOWED_VIEW_EQUIPMENT')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $equipment = $em->getRepository(Equipment::class)->queryAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $equipment,
            $request->query->getInt('page', 1),
            $this->getParameter('items_per_page'));

        return $this->render('equipment/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new equipment entity.
     *
     * @Route("/new", name="equipment_new")
     * @Method({"GET", "POST"})
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_EQUIPMENT')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $equipment = new Equipment();
        $form = $this->createForm('MMProjectBundle\Form\EquipmentType', $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipment);
            $em->flush();

            return $this->redirectToRoute('equipment_show', array('id' => $equipment->getId()));
        }

        return $this->render('equipment/new.html.twig', array(
            'equipment' => $equipment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equipment entity.
     *
     * @Route("/{id}", name="equipment_show")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ALLOWED_VIEW_EQUIPMENT')")
     *
     * @param Equipment $equipment
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Equipment $equipment)
    {
        $deleteForm = $this->createDeleteForm($equipment);

        return $this->render('equipment/show.html.twig', array(
            'equipment' => $equipment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing equipment entity.
     *
     * @Route("/{id}/edit", name="equipment_edit")
     * @Method({"GET", "POST"})
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_EQUIPMENT')")
     *
     * @param Request $request
     * @param Equipment $equipment
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Equipment $equipment)
    {
        $deleteForm = $this->createDeleteForm($equipment);
        $editForm = $this->createForm('MMProjectBundle\Form\EquipmentType', $equipment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipment_edit', array('id' => $equipment->getId()));
        }

        return $this->render('equipment/edit.html.twig', array(
            'equipment' => $equipment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a equipment entity.
     *
     * @Route("/{id}", name="equipment_delete")
     * @Method("DELETE")
     *
     * @Security("has_role('ROLE_ALLOWED_EDIT_EQUIPMENT')")
     *
     * @param Request $request
     * @param Equipment $equipment
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Equipment $equipment)
    {
        $form = $this->createDeleteForm($equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipment);
            $em->flush();
        }

        return $this->redirectToRoute('equipment_index');
    }

    /**
     * Creates a form to delete a equipment entity.
     *
     * @param Equipment $equipment The equipment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equipment $equipment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('equipment_delete', array('id' => $equipment->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
