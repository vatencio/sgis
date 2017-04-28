<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tbldocenteinstitucion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tbldocenteinstitucion controller.
 *
 */
class TbldocenteinstitucionController extends Controller
{
    /**
     * Lists all tbldocenteinstitucion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tbldocenteinstitucions = $em->getRepository('VatencioSgisBundle:Tbldocenteinstitucion')->findAll();

        return $this->render('tbldocenteinstitucion/index.html.twig', array(
            'tbldocenteinstitucions' => $tbldocenteinstitucions,
        ));
    }

    /**
     * Creates a new tbldocenteinstitucion entity.
     *
     */
    public function newAction(Request $request)
    {
        $tbldocenteinstitucion = new Tbldocenteinstitucion();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TbldocenteinstitucionType', $tbldocenteinstitucion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tbldocenteinstitucion);
            $em->flush($tbldocenteinstitucion);

            return $this->redirectToRoute('tbldocenteinstitucion_show', array('id' => $tbldocenteinstitucion->getId()));
        }

        return $this->render('tbldocenteinstitucion/new.html.twig', array(
            'tbldocenteinstitucion' => $tbldocenteinstitucion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tbldocenteinstitucion entity.
     *
     */
    public function showAction(Tbldocenteinstitucion $tbldocenteinstitucion)
    {
        $deleteForm = $this->createDeleteForm($tbldocenteinstitucion);

        return $this->render('tbldocenteinstitucion/show.html.twig', array(
            'tbldocenteinstitucion' => $tbldocenteinstitucion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tbldocenteinstitucion entity.
     *
     */
    public function editAction(Request $request, Tbldocenteinstitucion $tbldocenteinstitucion)
    {
        $deleteForm = $this->createDeleteForm($tbldocenteinstitucion);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TbldocenteinstitucionType', $tbldocenteinstitucion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tbldocenteinstitucion_edit', array('id' => $tbldocenteinstitucion->getId()));
        }

        return $this->render('tbldocenteinstitucion/edit.html.twig', array(
            'tbldocenteinstitucion' => $tbldocenteinstitucion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tbldocenteinstitucion entity.
     *
     */
    public function deleteAction(Request $request, Tbldocenteinstitucion $tbldocenteinstitucion)
    {
        $form = $this->createDeleteForm($tbldocenteinstitucion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tbldocenteinstitucion);
            $em->flush($tbldocenteinstitucion);
        }

        return $this->redirectToRoute('tbldocenteinstitucion_index');
    }

    /**
     * Creates a form to delete a tbldocenteinstitucion entity.
     *
     * @param Tbldocenteinstitucion $tbldocenteinstitucion The tbldocenteinstitucion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tbldocenteinstitucion $tbldocenteinstitucion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tbldocenteinstitucion_delete', array('id' => $tbldocenteinstitucion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
