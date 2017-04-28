<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblperiodo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblperiodo controller.
 *
 */
class TblperiodoController extends Controller
{
    /**
     * Lists all tblperiodo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblperiodos = $em->getRepository('VatencioSgisBundle:Tblperiodo')->findAll();

        return $this->render('tblperiodo/index.html.twig', array(
            'tblperiodos' => $tblperiodos,
        ));
    }

    /**
     * Creates a new tblperiodo entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblperiodo = new Tblperiodo();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblperiodoType', $tblperiodo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblperiodo);
            $em->flush($tblperiodo);

            return $this->redirectToRoute('tblperiodo_show', array('id' => $tblperiodo->getId()));
        }

        return $this->render('tblperiodo/new.html.twig', array(
            'tblperiodo' => $tblperiodo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblperiodo entity.
     *
     */
    public function showAction(Tblperiodo $tblperiodo)
    {
        $deleteForm = $this->createDeleteForm($tblperiodo);

        return $this->render('tblperiodo/show.html.twig', array(
            'tblperiodo' => $tblperiodo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblperiodo entity.
     *
     */
    public function editAction(Request $request, Tblperiodo $tblperiodo)
    {
        $deleteForm = $this->createDeleteForm($tblperiodo);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblperiodoType', $tblperiodo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblperiodo_edit', array('id' => $tblperiodo->getId()));
        }

        return $this->render('tblperiodo/edit.html.twig', array(
            'tblperiodo' => $tblperiodo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblperiodo entity.
     *
     */
    public function deleteAction(Request $request, Tblperiodo $tblperiodo)
    {
        $form = $this->createDeleteForm($tblperiodo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblperiodo);
            $em->flush($tblperiodo);
        }

        return $this->redirectToRoute('tblperiodo_index');
    }

    /**
     * Creates a form to delete a tblperiodo entity.
     *
     * @param Tblperiodo $tblperiodo The tblperiodo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblperiodo $tblperiodo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblperiodo_delete', array('id' => $tblperiodo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
