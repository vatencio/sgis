<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblinstitucion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblinstitucion controller.
 *
 */
class TblinstitucionController extends Controller
{
    /**
     * Lists all tblinstitucion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblinstitucions = $em->getRepository('VatencioSgisBundle:Tblinstitucion')->findAll();

        return $this->render('tblinstitucion/index.html.twig', array(
            'tblinstitucions' => $tblinstitucions,
        ));
    }

    /**
     * Creates a new tblinstitucion entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblinstitucion = new Tblinstitucion();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblinstitucionType', $tblinstitucion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblinstitucion);
            $em->flush($tblinstitucion);

            return $this->redirectToRoute('tblinstitucion_show', array('id' => $tblinstitucion->getId()));
        }

        return $this->render('tblinstitucion/new.html.twig', array(
            'tblinstitucion' => $tblinstitucion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblinstitucion entity.
     *
     */
    public function showAction(Tblinstitucion $tblinstitucion)
    {
        $deleteForm = $this->createDeleteForm($tblinstitucion);

        return $this->render('tblinstitucion/show.html.twig', array(
            'tblinstitucion' => $tblinstitucion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblinstitucion entity.
     *
     */
    public function editAction(Request $request, Tblinstitucion $tblinstitucion)
    {
        $deleteForm = $this->createDeleteForm($tblinstitucion);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblinstitucionType', $tblinstitucion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblinstitucion_edit', array('id' => $tblinstitucion->getId()));
        }

        return $this->render('tblinstitucion/edit.html.twig', array(
            'tblinstitucion' => $tblinstitucion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblinstitucion entity.
     *
     */
    public function deleteAction(Request $request, Tblinstitucion $tblinstitucion)
    {
        $form = $this->createDeleteForm($tblinstitucion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblinstitucion);
            $em->flush($tblinstitucion);
        }

        return $this->redirectToRoute('tblinstitucion_index');
    }

    /**
     * Creates a form to delete a tblinstitucion entity.
     *
     * @param Tblinstitucion $tblinstitucion The tblinstitucion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblinstitucion $tblinstitucion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblinstitucion_delete', array('id' => $tblinstitucion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
