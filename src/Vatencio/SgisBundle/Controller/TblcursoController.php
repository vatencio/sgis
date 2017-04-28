<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblcurso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblcurso controller.
 *
 */
class TblcursoController extends Controller
{
    /**
     * Lists all tblcurso entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblcursos = $em->getRepository('VatencioSgisBundle:Tblcurso')->findAll();

        return $this->render('tblcurso/index.html.twig', array(
            'tblcursos' => $tblcursos,
        ));
    }

    /**
     * Creates a new tblcurso entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblcurso = new Tblcurso();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblcursoType', $tblcurso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblcurso);
            $em->flush($tblcurso);

            return $this->redirectToRoute('tblcurso_show', array('id' => $tblcurso->getId()));
        }

        return $this->render('tblcurso/new.html.twig', array(
            'tblcurso' => $tblcurso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblcurso entity.
     *
     */
    public function showAction(Tblcurso $tblcurso)
    {
        $deleteForm = $this->createDeleteForm($tblcurso);

        return $this->render('tblcurso/show.html.twig', array(
            'tblcurso' => $tblcurso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblcurso entity.
     *
     */
    public function editAction(Request $request, Tblcurso $tblcurso)
    {
        $deleteForm = $this->createDeleteForm($tblcurso);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblcursoType', $tblcurso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblcurso_edit', array('id' => $tblcurso->getId()));
        }

        return $this->render('tblcurso/edit.html.twig', array(
            'tblcurso' => $tblcurso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblcurso entity.
     *
     */
    public function deleteAction(Request $request, Tblcurso $tblcurso)
    {
        $form = $this->createDeleteForm($tblcurso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblcurso);
            $em->flush($tblcurso);
        }

        return $this->redirectToRoute('tblcurso_index');
    }

    /**
     * Creates a form to delete a tblcurso entity.
     *
     * @param Tblcurso $tblcurso The tblcurso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblcurso $tblcurso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblcurso_delete', array('id' => $tblcurso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
