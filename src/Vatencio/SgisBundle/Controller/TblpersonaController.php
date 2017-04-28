<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblpersona;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Vatencio\SgisBundle\Form\Mostrar\SguPersonaUsuarioPerfilMostrarType;


/**
 * Tblpersona controller.
 *
 */
class TblpersonaController extends Controller
{
    /**
     * Lists all tblpersona entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblpersonas = $em->getRepository('VatencioSgisBundle:Tblpersona')->findAll();

        return $this->render('tblpersona/index.html.twig', array(
            'tblpersonas' => $tblpersonas,
        ));
    }

    /**
     * Creates a new tblpersona entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblpersona = new Tblpersona();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblpersonaType', $tblpersona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblpersona);
            $em->flush($tblpersona);

            return $this->redirectToRoute('tblpersona_show', array('id' => $tblpersona->getId()));
        }

        return $this->render('tblpersona/new.html.twig', array(
            'tblpersona' => $tblpersona,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblpersona entity.
     *
     */
    public function showAction(Tblpersona $tblpersona)
    {
        $deleteForm = $this->createDeleteForm($tblpersona);

        return $this->render('tblpersona/show.html.twig', array(
            'tblpersona' => $tblpersona,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblpersona entity.
     *
     */
    public function editAction(Request $request, Tblpersona $tblpersona)
    {
        $deleteForm = $this->createDeleteForm($tblpersona);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblpersonaType', $tblpersona);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblpersona_edit', array('id' => $tblpersona->getId()));
        }

        return $this->render('tblpersona/edit.html.twig', array(
            'tblpersona' => $tblpersona,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblpersona entity.
     *
     */
    public function deleteAction(Request $request, Tblpersona $tblpersona)
    {
        $form = $this->createDeleteForm($tblpersona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblpersona);
            $em->flush($tblpersona);
        }

        return $this->redirectToRoute('tblpersona_index');
    }

    /**
     * Creates a form to delete a tblpersona entity.
     *
     * @param Tblpersona $tblpersona The tblpersona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblpersona $tblpersona)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblpersona_delete', array('id' => $tblpersona->getIntidpersona())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
     
}
