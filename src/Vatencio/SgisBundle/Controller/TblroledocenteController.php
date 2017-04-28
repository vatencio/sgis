<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblroledocente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblroledocente controller.
 *
 */
class TblroledocenteController extends Controller
{
    /**
     * Lists all tblroledocente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblroledocentes = $em->getRepository('VatencioSgisBundle:Tblroledocente')->findAll();

        return $this->render('tblroledocente/index.html.twig', array(
            'tblroledocentes' => $tblroledocentes,
        ));
    }

    /**
     * Creates a new tblroledocente entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblroledocente = new Tblroledocente();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblroledocenteType', $tblroledocente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblroledocente);
            $em->flush($tblroledocente);

            return $this->redirectToRoute('tblroledocente_show', array('id' => $tblroledocente->getId()));
        }

        return $this->render('tblroledocente/new.html.twig', array(
            'tblroledocente' => $tblroledocente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblroledocente entity.
     *
     */
    public function showAction(Tblroledocente $tblroledocente)
    {
        $deleteForm = $this->createDeleteForm($tblroledocente);

        return $this->render('tblroledocente/show.html.twig', array(
            'tblroledocente' => $tblroledocente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblroledocente entity.
     *
     */
    public function editAction(Request $request, Tblroledocente $tblroledocente)
    {
        $deleteForm = $this->createDeleteForm($tblroledocente);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblroledocenteType', $tblroledocente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblroledocente_edit', array('id' => $tblroledocente->getId()));
        }

        return $this->render('tblroledocente/edit.html.twig', array(
            'tblroledocente' => $tblroledocente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblroledocente entity.
     *
     */
    public function deleteAction(Request $request, Tblroledocente $tblroledocente)
    {
        $form = $this->createDeleteForm($tblroledocente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblroledocente);
            $em->flush($tblroledocente);
        }

        return $this->redirectToRoute('tblroledocente_index');
    }

    /**
     * Creates a form to delete a tblroledocente entity.
     *
     * @param Tblroledocente $tblroledocente The tblroledocente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblroledocente $tblroledocente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblroledocente_delete', array('id' => $tblroledocente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
