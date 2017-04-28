<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblyear;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblyear controller.
 *
 */
class TblyearController extends Controller
{
    /**
     * Lists all tblyear entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblyears = $em->getRepository('VatencioSgisBundle:Tblyear')->findAll();

        return $this->render('tblyear/index.html.twig', array(
            'tblyears' => $tblyears,
        ));
    }

    /**
     * Creates a new tblyear entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblyear = new Tblyear();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblyearType', $tblyear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblyear);
            $em->flush($tblyear);

            return $this->redirectToRoute('tblyear_show', array('id' => $tblyear->getId()));
        }

        return $this->render('tblyear/new.html.twig', array(
            'tblyear' => $tblyear,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblyear entity.
     *
     */
    public function showAction(Tblyear $tblyear)
    {
        $deleteForm = $this->createDeleteForm($tblyear);

        return $this->render('tblyear/show.html.twig', array(
            'tblyear' => $tblyear,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblyear entity.
     *
     */
    public function editAction(Request $request, Tblyear $tblyear)
    {
        $deleteForm = $this->createDeleteForm($tblyear);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblyearType', $tblyear);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblyear_edit', array('id' => $tblyear->getId()));
        }

        return $this->render('tblyear/edit.html.twig', array(
            'tblyear' => $tblyear,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblyear entity.
     *
     */
    public function deleteAction(Request $request, Tblyear $tblyear)
    {
        $form = $this->createDeleteForm($tblyear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblyear);
            $em->flush($tblyear);
        }

        return $this->redirectToRoute('tblyear_index');
    }

    /**
     * Creates a form to delete a tblyear entity.
     *
     * @param Tblyear $tblyear The tblyear entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblyear $tblyear)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblyear_delete', array('id' => $tblyear->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
