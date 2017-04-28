<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblmenu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tblmenu controller.
 *
 */
class TblmenuController extends Controller
{
    /**
     * Lists all tblmenu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblmenus = $em->getRepository('VatencioSgisBundle:Tblmenu')->findAll();

        return $this->render('tblmenu/index.html.twig', array(
            'tblmenus' => $tblmenus,
        ));
    }

    /**
     * Creates a new tblmenu entity.
     *
     */
    public function newAction(Request $request)
    {
        $tblmenu = new Tblmenu();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TblmenuType', $tblmenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblmenu);
            $em->flush($tblmenu);

            return $this->redirectToRoute('tblmenu_show', array('id' => $tblmenu->getId()));
        }

        return $this->render('tblmenu/new.html.twig', array(
            'tblmenu' => $tblmenu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tblmenu entity.
     *
     */
    public function showAction(Tblmenu $tblmenu)
    {
        $deleteForm = $this->createDeleteForm($tblmenu);

        return $this->render('tblmenu/show.html.twig', array(
            'tblmenu' => $tblmenu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblmenu entity.
     *
     */
    public function editAction(Request $request, Tblmenu $tblmenu)
    {
        $deleteForm = $this->createDeleteForm($tblmenu);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblmenuType', $tblmenu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblmenu_edit', array('id' => $tblmenu->getId()));
        }

        return $this->render('tblmenu/edit.html.twig', array(
            'tblmenu' => $tblmenu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblmenu entity.
     *
     */
    public function deleteAction(Request $request, Tblmenu $tblmenu)
    {
        $form = $this->createDeleteForm($tblmenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblmenu);
            $em->flush($tblmenu);
        }

        return $this->redirectToRoute('tblmenu_index');
    }

    /**
     * Creates a form to delete a tblmenu entity.
     *
     * @param Tblmenu $tblmenu The tblmenu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblmenu $tblmenu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblmenu_delete', array('id' => $tblmenu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
