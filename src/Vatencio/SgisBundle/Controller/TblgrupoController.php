<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblgrupo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblgrupo controller.
 *
 */
class TblgrupoController extends Controller
{
    /**
     * Lists all tblgrupo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblgrupos = $em->getRepository('VatencioSgisBundle:Tblgrupo')->findAll();

        return $this->render('tblgrupo/index.html.twig', array(
            'tblgrupos' => $tblgrupos,
        ));
    }

    /**
     * Creates a new tblgrupo entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblgrupo = new Tblgrupo();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblgrupoType', $tblgrupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblgrupo);
            $em->flush($tblgrupo);

            return $this->redirectToRoute('tblgrupo_show', array('id' => $tblgrupo->getId()));
        }

        return $this->render('tblgrupo/new.html.twig', array(
            'tblgrupo' => $tblgrupo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblgrupo entity.
     *
     */
    public function showAction(Tblgrupo $tblgrupo)
    {
        $deleteForm = $this->createDeleteForm($tblgrupo);

        return $this->render('tblgrupo/show.html.twig', array(
            'tblgrupo' => $tblgrupo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblgrupo entity.
     *
     */
    public function editAction(Request $request, Tblgrupo $tblgrupo)
    {
        $deleteForm = $this->createDeleteForm($tblgrupo);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblgrupoType', $tblgrupo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblgrupo_edit', array('id' => $tblgrupo->getId()));
        }

        return $this->render('tblgrupo/edit.html.twig', array(
            'tblgrupo' => $tblgrupo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblgrupo entity.
     *
     */
    public function deleteAction(Request $request, Tblgrupo $tblgrupo)
    {
        $form = $this->createDeleteForm($tblgrupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblgrupo);
            $em->flush($tblgrupo);
        }

        return $this->redirectToRoute('tblgrupo_index');
    }

    /**
     * Creates a form to delete a tblgrupo entity.
     *
     * @param Tblgrupo $tblgrupo The tblgrupo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblgrupo $tblgrupo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblgrupo_delete', array('id' => $tblgrupo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
