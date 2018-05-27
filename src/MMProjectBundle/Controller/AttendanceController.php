<?php

namespace MMProjectBundle\Controller;

use MMProjectBundle\Entity\Attendance;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Attendance controller.
 *
 * @Route("attendance")
 */
class AttendanceController extends Controller
{
    /**
     * Lists all attendance entities.
     *
     * @Route("/", name="attendance_index")
     * @Method("GET")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $attendances = $em->getRepository(Attendance::class)->queryAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $attendances,
            $request->query->getInt('page', 1),
            10);

        return $this->render('attendance/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new attendance entity.
     *
     * @Route("/new", name="attendance_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $attendance = new Attendance();
        $form = $this->createForm('MMProjectBundle\Form\AttendanceType', $attendance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attendance);
            $em->flush();

            return $this->redirectToRoute('attendance_show', array('id' => $attendance->getId()));
        }

        return $this->render('attendance/new.html.twig', array(
            'attendance' => $attendance,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a attendance entity.
     *
     * @Route("/{id}", name="attendance_show")
     * @Method("GET")
     *
     * @param Attendance $attendance
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Attendance $attendance)
    {
        $deleteForm = $this->createDeleteForm($attendance);

        return $this->render('attendance/show.html.twig', array(
            'attendance' => $attendance,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing attendance entity.
     *
     * @Route("/{id}/edit", name="attendance_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Attendance $attendance
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Attendance $attendance)
    {
        $deleteForm = $this->createDeleteForm($attendance);
        $editForm = $this->createForm('MMProjectBundle\Form\AttendanceType', $attendance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('attendance_edit', array('id' => $attendance->getId()));
        }

        return $this->render('attendance/edit.html.twig', array(
            'attendance' => $attendance,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a attendance entity.
     *
     * @Route("/{id}", name="attendance_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param Attendance $attendance
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Attendance $attendance)
    {
        $form = $this->createDeleteForm($attendance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($attendance);
            $em->flush();
        }

        return $this->redirectToRoute('attendance_index');
    }

    /**
     * Creates a form to delete a attendance entity.
     *
     * @param Attendance $attendance The attendance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Attendance $attendance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('attendance_delete', array('id' => $attendance->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
