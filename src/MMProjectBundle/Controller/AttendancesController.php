<?php

namespace MMProjectBundle\Controller;

use MMProjectBundle\Entity\Attendances;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Attendance controller.
 *
 * @Route("attendances")
 */
class AttendancesController extends Controller
{
    /**
     * Lists all attendance entities.
     *
     * @Route("/", name="attendances_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $attendances = $em->getRepository('MMProjectBundle:Attendances')->findAll();

        return $this->render('attendances/index.html.twig', array(
            'attendances' => $attendances,
        ));
    }

    /**
     * Creates a new attendance entity.
     *
     * @Route("/new", name="attendances_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $attendance = new Attendances();
        $form = $this->createForm('MMProjectBundle\Form\AttendancesType', $attendance);
        $form->handleRequest($request);
        $attendance->setVersion(1);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attendance);
            $em->flush();

            return $this->redirectToRoute('attendances_show', array('id' => $attendance->getId()));
        }

        return $this->render('attendances/new.html.twig', array(
            'attendance' => $attendance,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a attendance entity.
     *
     * @Route("/{id}", name="attendances_show")
     * @Method("GET")
     */
    public function showAction(Attendances $attendance)
    {
        $deleteForm = $this->createDeleteForm($attendance);

        return $this->render('attendances/show.html.twig', array(
            'attendance' => $attendance,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing attendance entity.
     *
     * @Route("/{id}/edit", name="attendances_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Attendances $attendance)
    {
        $deleteForm = $this->createDeleteForm($attendance);
        $editForm = $this->createForm('MMProjectBundle\Form\AttendancesType', $attendance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('attendances_edit', array('id' => $attendance->getId()));
        }

        return $this->render('attendances/edit.html.twig', array(
            'attendance' => $attendance,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a attendance entity.
     *
     * @Route("/{id}", name="attendances_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Attendances $attendance)
    {
        $form = $this->createDeleteForm($attendance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($attendance);
            $em->flush();
        }

        return $this->redirectToRoute('attendances_index');
    }

    /**
     * Creates a form to delete a attendance entity.
     *
     * @param Attendances $attendance The attendance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Attendances $attendance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('attendances_delete', array('id' => $attendance->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
