<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblmateriaestudiante;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblmateriaestudiante controller.
 *
 */
class TblmateriaestudianteController extends Controller
{
    /**
     * Lists all tblmateriaestudiante entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblmateriaestudiantes = $em->getRepository('VatencioSgisBundle:Tblmateriaestudiante')->findAll();

        return $this->render('tblmateriaestudiante/index.html.twig', array(
            'tblmateriaestudiantes' => $tblmateriaestudiantes,
        ));
    }

    /**
     * Creates a new tblmateriaestudiante entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblmateriaestudiante = new Tblmateriaestudiante();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblmateriaestudianteType', $tblmateriaestudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblmateriaestudiante);
            $em->flush($tblmateriaestudiante);

            return $this->redirectToRoute('tblmateriaestudiante_show', array('id' => $tblmateriaestudiante->getId()));
        }

        return $this->render('tblmateriaestudiante/new.html.twig', array(
            'tblmateriaestudiante' => $tblmateriaestudiante,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblmateriaestudiante entity.
     *
     */
    public function showAction(Tblmateriaestudiante $tblmateriaestudiante)
    {
        $deleteForm = $this->createDeleteForm($tblmateriaestudiante);

        return $this->render('tblmateriaestudiante/show.html.twig', array(
            'tblmateriaestudiante' => $tblmateriaestudiante,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblmateriaestudiante entity.
     *
     */
    public function editAction(Request $request, Tblmateriaestudiante $tblmateriaestudiante)
    {
        $deleteForm = $this->createDeleteForm($tblmateriaestudiante);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblmateriaestudianteType', $tblmateriaestudiante);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblmateriaestudiante_edit', array('id' => $tblmateriaestudiante->getId()));
        }

        return $this->render('tblmateriaestudiante/edit.html.twig', array(
            'tblmateriaestudiante' => $tblmateriaestudiante,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblmateriaestudiante entity.
     *
     */
    public function deleteAction(Request $request, Tblmateriaestudiante $tblmateriaestudiante)
    {
        $form = $this->createDeleteForm($tblmateriaestudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblmateriaestudiante);
            $em->flush($tblmateriaestudiante);
        }

        return $this->redirectToRoute('tblmateriaestudiante_index');
    }

    /**
     * Creates a form to delete a tblmateriaestudiante entity.
     *
     * @param Tblmateriaestudiante $tblmateriaestudiante The tblmateriaestudiante entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblmateriaestudiante $tblmateriaestudiante)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblmateriaestudiante_delete', array('id' => $tblmateriaestudiante->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
