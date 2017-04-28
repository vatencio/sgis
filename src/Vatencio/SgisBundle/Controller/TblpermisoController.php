<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblpermiso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblpermiso controller.
 *
 */
class TblpermisoController extends Controller
{
    /**
     * Lists all tblpermiso entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblpermisos = $em->getRepository('VatencioSgisBundle:Tblpermiso')->findAll();

        return $this->render('tblpermiso/index.html.twig', array(
            'tblpermisos' => $tblpermisos,
        ));
    }

    /**
     * Creates a new tblpermiso entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblpermiso = new Tblpermiso();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblpermisoType', $tblpermiso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblpermiso);
            $em->flush($tblpermiso);

            return $this->redirectToRoute('tblpermiso_show', array('id' => $tblpermiso->getId()));
        }

        return $this->render('tblpermiso/new.html.twig', array(
            'tblpermiso' => $tblpermiso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblpermiso entity.
     *
     */
    public function showAction(Tblpermiso $tblpermiso)
    {
        $deleteForm = $this->createDeleteForm($tblpermiso);

        return $this->render('tblpermiso/show.html.twig', array(
            'tblpermiso' => $tblpermiso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblpermiso entity.
     *
     */
    public function editAction(Request $request, Tblpermiso $tblpermiso)
    {
        $deleteForm = $this->createDeleteForm($tblpermiso);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblpermisoType', $tblpermiso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblpermiso_edit', array('id' => $tblpermiso->getId()));
        }

        return $this->render('tblpermiso/edit.html.twig', array(
            'tblpermiso' => $tblpermiso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblpermiso entity.
     *
     */
    public function deleteAction(Request $request, Tblpermiso $tblpermiso)
    {
        $form = $this->createDeleteForm($tblpermiso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblpermiso);
            $em->flush($tblpermiso);
        }

        return $this->redirectToRoute('tblpermiso_index');
    }

    /**
     * Creates a form to delete a tblpermiso entity.
     *
     * @param Tblpermiso $tblpermiso The tblpermiso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblpermiso $tblpermiso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblpermiso_delete', array('id' => $tblpermiso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
