<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblsede;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblsede controller.
 *
 */
class TblsedeController extends Controller
{
    /**
     * Lists all tblsede entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblsedes = $em->getRepository('VatencioSgisBundle:Tblsede')->findAll();

        return $this->render('tblsede/index.html.twig', array(
            'tblsedes' => $tblsedes,
        ));
    }

    /**
     * Creates a new tblsede entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblsede = new Tblsede();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblsedeType', $tblsede);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblsede);
            $em->flush($tblsede);

            return $this->redirectToRoute('tblsede_show', array('id' => $tblsede->getId()));
        }

        return $this->render('tblsede/new.html.twig', array(
            'tblsede' => $tblsede,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblsede entity.
     *
     */
    public function showAction(Tblsede $tblsede)
    {
        $deleteForm = $this->createDeleteForm($tblsede);

        return $this->render('tblsede/show.html.twig', array(
            'tblsede' => $tblsede,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblsede entity.
     *
     */
    public function editAction(Request $request, Tblsede $tblsede)
    {
        $deleteForm = $this->createDeleteForm($tblsede);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblsedeType', $tblsede);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblsede_edit', array('id' => $tblsede->getId()));
        }

        return $this->render('tblsede/edit.html.twig', array(
            'tblsede' => $tblsede,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblsede entity.
     *
     */
    public function deleteAction(Request $request, Tblsede $tblsede)
    {
        $form = $this->createDeleteForm($tblsede);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblsede);
            $em->flush($tblsede);
        }

        return $this->redirectToRoute('tblsede_index');
    }

    /**
     * Creates a form to delete a tblsede entity.
     *
     * @param Tblsede $tblsede The tblsede entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblsede $tblsede)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblsede_delete', array('id' => $tblsede->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
