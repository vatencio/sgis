<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tbltipodocumento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tbltipodocumento controller.
 *
 */
class TbltipodocumentoController extends Controller
{
    /**
     * Lists all tbltipodocumento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tbltipodocumentos = $em->getRepository('VatencioSgisBundle:Tbltipodocumento')->findAll();

        return $this->render('tbltipodocumento/index.html.twig', array(
            'tbltipodocumentos' => $tbltipodocumentos,
        ));
    }

    /**
     * Creates a new tbltipodocumento entity.
     *
     */
    public function newAction(Request $request)
    {
        $tbltipodocumento = new Tbltipodocumento();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TbltipodocumentoType', $tbltipodocumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tbltipodocumento);
            $em->flush($tbltipodocumento);

            return $this->redirectToRoute('tbltipodocumento_show', array('id' => $tbltipodocumento->getId()));
        }

        return $this->render('tbltipodocumento/new.html.twig', array(
            'tbltipodocumento' => $tbltipodocumento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tbltipodocumento entity.
     *
     */
    public function showAction(Tbltipodocumento $tbltipodocumento)
    {
        $deleteForm = $this->createDeleteForm($tbltipodocumento);

        return $this->render('tbltipodocumento/show.html.twig', array(
            'tbltipodocumento' => $tbltipodocumento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tbltipodocumento entity.
     *
     */
    public function editAction(Request $request, Tbltipodocumento $tbltipodocumento)
    {
        $deleteForm = $this->createDeleteForm($tbltipodocumento);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TbltipodocumentoType', $tbltipodocumento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tbltipodocumento_edit', array('id' => $tbltipodocumento->getId()));
        }

        return $this->render('tbltipodocumento/edit.html.twig', array(
            'tbltipodocumento' => $tbltipodocumento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tbltipodocumento entity.
     *
     */
    public function deleteAction(Request $request, Tbltipodocumento $tbltipodocumento)
    {
        $form = $this->createDeleteForm($tbltipodocumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tbltipodocumento);
            $em->flush($tbltipodocumento);
        }

        return $this->redirectToRoute('tbltipodocumento_index');
    }

    /**
     * Creates a form to delete a tbltipodocumento entity.
     *
     * @param Tbltipodocumento $tbltipodocumento The tbltipodocumento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tbltipodocumento $tbltipodocumento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tbltipodocumento_delete', array('id' => $tbltipodocumento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
