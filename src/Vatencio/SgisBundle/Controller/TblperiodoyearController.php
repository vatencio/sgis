<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblperiodoyear;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblperiodoyear controller.
 *
 */
class TblperiodoyearController extends Controller
{
    /**
     * Lists all tblperiodoyear entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblperiodoyears = $em->getRepository('VatencioSgisBundle:Tblperiodoyear')->findAll();

        return $this->render('tblperiodoyear/index.html.twig', array(
            'tblperiodoyears' => $tblperiodoyears,
        ));
    }

    /**
     * Creates a new tblperiodoyear entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblperiodoyear = new Tblperiodoyear();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblperiodoyearType', $tblperiodoyear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblperiodoyear);
            $em->flush($tblperiodoyear);

            return $this->redirectToRoute('tblperiodoyear_show', array('id' => $tblperiodoyear->getId()));
        }

        return $this->render('tblperiodoyear/new.html.twig', array(
            'tblperiodoyear' => $tblperiodoyear,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblperiodoyear entity.
     *
     */
    public function showAction(Tblperiodoyear $tblperiodoyear)
    {
        $deleteForm = $this->createDeleteForm($tblperiodoyear);

        return $this->render('tblperiodoyear/show.html.twig', array(
            'tblperiodoyear' => $tblperiodoyear,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblperiodoyear entity.
     *
     */
    public function editAction(Request $request, Tblperiodoyear $tblperiodoyear)
    {
        $deleteForm = $this->createDeleteForm($tblperiodoyear);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblperiodoyearType', $tblperiodoyear);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblperiodoyear_edit', array('id' => $tblperiodoyear->getId()));
        }

        return $this->render('tblperiodoyear/edit.html.twig', array(
            'tblperiodoyear' => $tblperiodoyear,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblperiodoyear entity.
     *
     */
    public function deleteAction(Request $request, Tblperiodoyear $tblperiodoyear)
    {
        $form = $this->createDeleteForm($tblperiodoyear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblperiodoyear);
            $em->flush($tblperiodoyear);
        }

        return $this->redirectToRoute('tblperiodoyear_index');
    }

    /**
     * Creates a form to delete a tblperiodoyear entity.
     *
     * @param Tblperiodoyear $tblperiodoyear The tblperiodoyear entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblperiodoyear $tblperiodoyear)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblperiodoyear_delete', array('id' => $tblperiodoyear->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
