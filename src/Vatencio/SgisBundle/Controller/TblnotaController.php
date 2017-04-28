<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblnota;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblnotum controller.
 *
 */
class TblnotaController extends Controller
{
    /**
     * Lists all tblnotum entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblnotas = $em->getRepository('VatencioSgisBundle:Tblnota')->findAll();

        return $this->render('tblnota/index.html.twig', array(
            'tblnotas' => $tblnotas,
        ));
    }

    /**
     * Creates a new tblnotum entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblnotum = new Tblnotum();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblnotaType', $tblnotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblnotum);
            $em->flush($tblnotum);

            return $this->redirectToRoute('tblnota_show', array('id' => $tblnotum->getId()));
        }

        return $this->render('tblnota/new.html.twig', array(
            'tblnotum' => $tblnotum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblnotum entity.
     *
     */
    public function showAction(Tblnota $tblnotum)
    {
        $deleteForm = $this->createDeleteForm($tblnotum);

        return $this->render('tblnota/show.html.twig', array(
            'tblnotum' => $tblnotum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblnotum entity.
     *
     */
    public function editAction(Request $request, Tblnota $tblnotum)
    {
        $deleteForm = $this->createDeleteForm($tblnotum);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblnotaType', $tblnotum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblnota_edit', array('id' => $tblnotum->getId()));
        }

        return $this->render('tblnota/edit.html.twig', array(
            'tblnotum' => $tblnotum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblnotum entity.
     *
     */
    public function deleteAction(Request $request, Tblnota $tblnotum)
    {
        $form = $this->createDeleteForm($tblnotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblnotum);
            $em->flush($tblnotum);
        }

        return $this->redirectToRoute('tblnota_index');
    }

    /**
     * Creates a form to delete a tblnotum entity.
     *
     * @param Tblnota $tblnotum The tblnotum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblnota $tblnotum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblnota_delete', array('id' => $tblnotum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
