<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tbllogro;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tbllogro controller.
 *
 */
class TbllogroController extends Controller
{
    /**
     * Lists all tbllogro entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tbllogros = $em->getRepository('VatencioSgisBundle:Tbllogro')->findAll();

        return $this->render('tbllogro/index.html.twig', array(
            'tbllogros' => $tbllogros,
        ));
    }

    /**
     * Creates a new tbllogro entity.
     *
     */
    public function newAction(Request $request)
    {
        $tbllogro = new Tbllogro();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TbllogroType', $tbllogro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tbllogro);
            $em->flush($tbllogro);

            return $this->redirectToRoute('tbllogro_show', array('id' => $tbllogro->getId()));
        }

        return $this->render('tbllogro/new.html.twig', array(
            'tbllogro' => $tbllogro,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tbllogro entity.
     *
     */
    public function showAction(Tbllogro $tbllogro)
    {
        $deleteForm = $this->createDeleteForm($tbllogro);

        return $this->render('tbllogro/show.html.twig', array(
            'tbllogro' => $tbllogro,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tbllogro entity.
     *
     */
    public function editAction(Request $request, Tbllogro $tbllogro)
    {
        $deleteForm = $this->createDeleteForm($tbllogro);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TbllogroType', $tbllogro);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tbllogro_edit', array('id' => $tbllogro->getId()));
        }

        return $this->render('tbllogro/edit.html.twig', array(
            'tbllogro' => $tbllogro,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tbllogro entity.
     *
     */
    public function deleteAction(Request $request, Tbllogro $tbllogro)
    {
        $form = $this->createDeleteForm($tbllogro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tbllogro);
            $em->flush($tbllogro);
        }

        return $this->redirectToRoute('tbllogro_index');
    }

    /**
     * Creates a form to delete a tbllogro entity.
     *
     * @param Tbllogro $tbllogro The tbllogro entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tbllogro $tbllogro)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tbllogro_delete', array('id' => $tbllogro->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
