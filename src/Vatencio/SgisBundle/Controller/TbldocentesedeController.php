<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tbldocentesede;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tbldocentesede controller.
 *
 */
class TbldocentesedeController extends Controller
{
    /**
     * Lists all tbldocentesede entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tbldocentesedes = $em->getRepository('VatencioSgisBundle:Tbldocentesede')->findAll();

        return $this->render('tbldocentesede/index.html.twig', array(
            'tbldocentesedes' => $tbldocentesedes,
        ));
    }

    /**
     * Creates a new tbldocentesede entity.
     *
     */
    public function newAction(Request $request)
    {
        $tbldocentesede = new Tbldocentesede();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TbldocentesedeType', $tbldocentesede);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tbldocentesede);
            $em->flush($tbldocentesede);

            return $this->redirectToRoute('tbldocentesede_show', array('id' => $tbldocentesede->getId()));
        }

        return $this->render('tbldocentesede/new.html.twig', array(
            'tbldocentesede' => $tbldocentesede,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tbldocentesede entity.
     *
     */
    public function showAction(Tbldocentesede $tbldocentesede)
    {
        $deleteForm = $this->createDeleteForm($tbldocentesede);

        return $this->render('tbldocentesede/show.html.twig', array(
            'tbldocentesede' => $tbldocentesede,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tbldocentesede entity.
     *
     */
    public function editAction(Request $request, Tbldocentesede $tbldocentesede)
    {
        $deleteForm = $this->createDeleteForm($tbldocentesede);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TbldocentesedeType', $tbldocentesede);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tbldocentesede_edit', array('id' => $tbldocentesede->getId()));
        }

        return $this->render('tbldocentesede/edit.html.twig', array(
            'tbldocentesede' => $tbldocentesede,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tbldocentesede entity.
     *
     */
    public function deleteAction(Request $request, Tbldocentesede $tbldocentesede)
    {
        $form = $this->createDeleteForm($tbldocentesede);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tbldocentesede);
            $em->flush($tbldocentesede);
        }

        return $this->redirectToRoute('tbldocentesede_index');
    }

    /**
     * Creates a form to delete a tbldocentesede entity.
     *
     * @param Tbldocentesede $tbldocentesede The tbldocentesede entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tbldocentesede $tbldocentesede)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tbldocentesede_delete', array('id' => $tbldocentesede->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
