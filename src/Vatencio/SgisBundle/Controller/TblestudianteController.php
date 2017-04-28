<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblestudiante;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblestudiante controller.
 *
 */
class TblestudianteController extends Controller
{
    /**
     * Lists all tblestudiante entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblestudiantes = $em->getRepository('VatencioSgisBundle:Tblestudiante')->findAll();

        return $this->render('tblestudiante/index.html.twig', array(
            'tblestudiantes' => $tblestudiantes,
        ));
    }

    /**
     * Creates a new tblestudiante entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblestudiante = new Tblestudiante();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblestudianteType', $tblestudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblestudiante);
            $em->flush($tblestudiante);

            return $this->redirectToRoute('tblestudiante_show', array('id' => $tblestudiante->getId()));
        }

        return $this->render('tblestudiante/new.html.twig', array(
            'tblestudiante' => $tblestudiante,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblestudiante entity.
     *
     */
    public function showAction(Tblestudiante $tblestudiante)
    {
        $deleteForm = $this->createDeleteForm($tblestudiante);

        return $this->render('tblestudiante/show.html.twig', array(
            'tblestudiante' => $tblestudiante,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblestudiante entity.
     *
     */
    public function editAction(Request $request, Tblestudiante $tblestudiante)
    {
        $deleteForm = $this->createDeleteForm($tblestudiante);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblestudianteType', $tblestudiante);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblestudiante_edit', array('id' => $tblestudiante->getId()));
        }

        return $this->render('tblestudiante/edit.html.twig', array(
            'tblestudiante' => $tblestudiante,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblestudiante entity.
     *
     */
    public function deleteAction(Request $request, Tblestudiante $tblestudiante)
    {
        $form = $this->createDeleteForm($tblestudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblestudiante);
            $em->flush($tblestudiante);
        }

        return $this->redirectToRoute('tblestudiante_index');
    }

    /**
     * Creates a form to delete a tblestudiante entity.
     *
     * @param Tblestudiante $tblestudiante The tblestudiante entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblestudiante $tblestudiante)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblestudiante_delete', array('id' => $tblestudiante->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
