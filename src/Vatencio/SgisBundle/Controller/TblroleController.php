<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblrole;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblrole controller.
 *
 */
class TblroleController extends Controller
{
    /**
     * Lists all tblrole entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblroles = $em->getRepository('VatencioSgisBundle:Tblrole')->findAll();

        return $this->render('tblrole/index.html.twig', array(
            'tblroles' => $tblroles,
        ));
    }

    /**
     * Creates a new tblrole entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblrole = new Tblrole();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblroleType', $tblrole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblrole);
            $em->flush($tblrole);

            return $this->redirectToRoute('tblrole_show', array('id' => $tblrole->getId()));
        }

        return $this->render('tblrole/new.html.twig', array(
            'tblrole' => $tblrole,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblrole entity.
     *
     */
    public function showAction(Tblrole $tblrole)
    {
        $deleteForm = $this->createDeleteForm($tblrole);

        return $this->render('tblrole/show.html.twig', array(
            'tblrole' => $tblrole,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblrole entity.
     *
     */
    public function editAction(Request $request, Tblrole $tblrole)
    {
        $deleteForm = $this->createDeleteForm($tblrole);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblroleType', $tblrole);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblrole_edit', array('id' => $tblrole->getId()));
        }

        return $this->render('tblrole/edit.html.twig', array(
            'tblrole' => $tblrole,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblrole entity.
     *
     */
    public function deleteAction(Request $request, Tblrole $tblrole)
    {
        $form = $this->createDeleteForm($tblrole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblrole);
            $em->flush($tblrole);
        }

        return $this->redirectToRoute('tblrole_index');
    }

    /**
     * Creates a form to delete a tblrole entity.
     *
     * @param Tblrole $tblrole The tblrole entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblrole $tblrole)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblrole_delete', array('id' => $tblrole->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
