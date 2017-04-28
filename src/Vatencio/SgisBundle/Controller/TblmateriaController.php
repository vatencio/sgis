<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblmateria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblmaterium controller.
 *
 */
class TblmateriaController extends Controller
{
    /**
     * Lists all tblmaterium entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblmaterias = $em->getRepository('VatencioSgisBundle:Tblmateria')->findAll();

        return $this->render('tblmateria/index.html.twig', array(
            'tblmaterias' => $tblmaterias,
        ));
    }

    /**
     * Creates a new tblmaterium entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblmaterium = new Tblmaterium();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblmateriaType', $tblmaterium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblmaterium);
            $em->flush($tblmaterium);

            return $this->redirectToRoute('tblmateria_show', array('id' => $tblmaterium->getId()));
        }

        return $this->render('tblmateria/new.html.twig', array(
            'tblmaterium' => $tblmaterium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblmaterium entity.
     *
     */
    public function showAction(Tblmateria $tblmaterium)
    {
        $deleteForm = $this->createDeleteForm($tblmaterium);

        return $this->render('tblmateria/show.html.twig', array(
            'tblmaterium' => $tblmaterium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblmaterium entity.
     *
     */
    public function editAction(Request $request, Tblmateria $tblmaterium)
    {
        $deleteForm = $this->createDeleteForm($tblmaterium);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblmateriaType', $tblmaterium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblmateria_edit', array('id' => $tblmaterium->getId()));
        }

        return $this->render('tblmateria/edit.html.twig', array(
            'tblmaterium' => $tblmaterium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblmaterium entity.
     *
     */
    public function deleteAction(Request $request, Tblmateria $tblmaterium)
    {
        $form = $this->createDeleteForm($tblmaterium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblmaterium);
            $em->flush($tblmaterium);
        }

        return $this->redirectToRoute('tblmateria_index');
    }

    /**
     * Creates a form to delete a tblmaterium entity.
     *
     * @param Tblmateria $tblmaterium The tblmaterium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblmateria $tblmaterium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblmateria_delete', array('id' => $tblmaterium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
