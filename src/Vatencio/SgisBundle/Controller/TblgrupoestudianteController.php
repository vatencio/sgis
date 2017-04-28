<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblgrupoestudiante;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblgrupoestudiante controller.
 *
 */
class TblgrupoestudianteController extends Controller
{
    /**
     * Lists all tblgrupoestudiante entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblgrupoestudiantes = $em->getRepository('VatencioSgisBundle:Tblgrupoestudiante')->findAll();

        return $this->render('tblgrupoestudiante/index.html.twig', array(
            'tblgrupoestudiantes' => $tblgrupoestudiantes,
        ));
    }

    /**
     * Creates a new tblgrupoestudiante entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblgrupoestudiante = new Tblgrupoestudiante();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblgrupoestudianteType', $tblgrupoestudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblgrupoestudiante);
            $em->flush($tblgrupoestudiante);

            return $this->redirectToRoute('tblgrupoestudiante_show', array('id' => $tblgrupoestudiante->getId()));
        }

        return $this->render('tblgrupoestudiante/new.html.twig', array(
            'tblgrupoestudiante' => $tblgrupoestudiante,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblgrupoestudiante entity.
     *
     */
    public function showAction(Tblgrupoestudiante $tblgrupoestudiante)
    {
        $deleteForm = $this->createDeleteForm($tblgrupoestudiante);

        return $this->render('tblgrupoestudiante/show.html.twig', array(
            'tblgrupoestudiante' => $tblgrupoestudiante,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblgrupoestudiante entity.
     *
     */
    public function editAction(Request $request, Tblgrupoestudiante $tblgrupoestudiante)
    {
        $deleteForm = $this->createDeleteForm($tblgrupoestudiante);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblgrupoestudianteType', $tblgrupoestudiante);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblgrupoestudiante_edit', array('id' => $tblgrupoestudiante->getId()));
        }

        return $this->render('tblgrupoestudiante/edit.html.twig', array(
            'tblgrupoestudiante' => $tblgrupoestudiante,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblgrupoestudiante entity.
     *
     */
    public function deleteAction(Request $request, Tblgrupoestudiante $tblgrupoestudiante)
    {
        $form = $this->createDeleteForm($tblgrupoestudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblgrupoestudiante);
            $em->flush($tblgrupoestudiante);
        }

        return $this->redirectToRoute('tblgrupoestudiante_index');
    }

    /**
     * Creates a form to delete a tblgrupoestudiante entity.
     *
     * @param Tblgrupoestudiante $tblgrupoestudiante The tblgrupoestudiante entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblgrupoestudiante $tblgrupoestudiante)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblgrupoestudiante_delete', array('id' => $tblgrupoestudiante->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
