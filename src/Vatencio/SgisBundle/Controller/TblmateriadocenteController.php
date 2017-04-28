<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblmateriadocente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblmateriadocente controller.
 *
 */
class TblmateriadocenteController extends Controller
{
    /**
     * Lists all tblmateriadocente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblmateriadocentes = $em->getRepository('VatencioSgisBundle:Tblmateriadocente')->findAll();

        return $this->render('tblmateriadocente/index.html.twig', array(
            'tblmateriadocentes' => $tblmateriadocentes,
        ));
    }

    /**
     * Creates a new tblmateriadocente entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblmateriadocente = new Tblmateriadocente();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblmateriadocenteType', $tblmateriadocente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblmateriadocente);
            $em->flush($tblmateriadocente);

            return $this->redirectToRoute('tblmateriadocente_show', array('id' => $tblmateriadocente->getId()));
        }

        return $this->render('tblmateriadocente/new.html.twig', array(
            'tblmateriadocente' => $tblmateriadocente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblmateriadocente entity.
     *
     */
    public function showAction(Tblmateriadocente $tblmateriadocente)
    {
        $deleteForm = $this->createDeleteForm($tblmateriadocente);

        return $this->render('tblmateriadocente/show.html.twig', array(
            'tblmateriadocente' => $tblmateriadocente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblmateriadocente entity.
     *
     */
    public function editAction(Request $request, Tblmateriadocente $tblmateriadocente)
    {
        $deleteForm = $this->createDeleteForm($tblmateriadocente);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblmateriadocenteType', $tblmateriadocente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblmateriadocente_edit', array('id' => $tblmateriadocente->getId()));
        }

        return $this->render('tblmateriadocente/edit.html.twig', array(
            'tblmateriadocente' => $tblmateriadocente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblmateriadocente entity.
     *
     */
    public function deleteAction(Request $request, Tblmateriadocente $tblmateriadocente)
    {
        $form = $this->createDeleteForm($tblmateriadocente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblmateriadocente);
            $em->flush($tblmateriadocente);
        }

        return $this->redirectToRoute('tblmateriadocente_index');
    }

    /**
     * Creates a form to delete a tblmateriadocente entity.
     *
     * @param Tblmateriadocente $tblmateriadocente The tblmateriadocente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblmateriadocente $tblmateriadocente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblmateriadocente_delete', array('id' => $tblmateriadocente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
