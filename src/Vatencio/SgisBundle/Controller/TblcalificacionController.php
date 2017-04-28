<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tblcalificacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vatencio\SgisBundle\Form\TblcalificacionType;

/**
 * Tblcalificacion controller.
 *
 */
class TblcalificacionController extends Controller
{
    /**
     * Lists all tblcalificacion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tblcalificacions = $em->getRepository('VatencioSgisBundle:Tblcalificacion')->findAll();

//        return $this->render('tblcalificacion/index.html.twig', array(
//            'tblcalificacions' => $tblcalificacions,
//        ));
        
        return $this->render('VatencioSgisBundle:Tblcalificacion:index.html.twig', array(
            'tblcalificacions' => $tblcalificacions,
        ));
    }

    /**
     * Creates a new tblcalificacion entity.
     *
     */
    public function newAction(Request $request)
    {
        //var_dump("1");
        $tblcalificacion = new Tblcalificacion();
        $form = $this->createForm( 'Vatencio\SgisBundle\Form\TblcalificacionType', $tblcalificacion);
        $form->handleRequest($request);
        // var_dump($form->isSubmitted() && $form->isValid());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tblcalificacion);
            $em->flush($tblcalificacion);
            var_dump("2");
            //return $this->redirectToRoute('tblcalificacion_show', array('id' => $tblcalificacion->getId()));
            return new Response(json_encode(array("html" => "","valid" => true)));
        }
        else if ($form->isSubmitted()){
            var_dump("3");
            $html = $this->render('VatencioSgisBundle:Tblcalificacion:new.html.twig', array(
                'tblcalificacion' => $tblcalificacion,
                'form' => $form->createView(),
            ));
        
            return new Response(json_encode(array("html" => $html->getContent(),"valid" => false)));
        }

        return $this->render('VatencioSgisBundle:Tblcalificacion:new.html.twig', array(
            'tblcalificacion' => $tblcalificacion,    
            'form' => $form->createView(),
        ));

//        return $this->render('VatencioSgisBundle:Tblcalificacion:new.html.twig', array(
//            'tblcalificacion' => $tblcalificacion,
//            'form' => $form->createView(),
//        ));
    }

    /**
     * Finds and displays a tblcalificacion entity.
     *
     */
    public function showAction(Tblcalificacion $tblcalificacion)
    {
        $deleteForm = $this->createDeleteForm($tblcalificacion);

        return $this->render('tblcalificacion/show.html.twig', array(
            'tblcalificacion' => $tblcalificacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tblcalificacion entity.
     *
     */
    public function editAction(Request $request, Tblcalificacion $tblcalificacion)
    {
        $deleteForm = $this->createDeleteForm($tblcalificacion);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TblcalificacionType', $tblcalificacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tblcalificacion_edit', array('id' => $tblcalificacion->getId()));
        }

        return $this->render('tblcalificacion/edit.html.twig', array(
            'tblcalificacion' => $tblcalificacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tblcalificacion entity.
     *
     */
    public function deleteAction(Request $request, Tblcalificacion $tblcalificacion)
    {
        $form = $this->createDeleteForm($tblcalificacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tblcalificacion);
            $em->flush($tblcalificacion);
        }

        return $this->redirectToRoute('tblcalificacion_index');
    }

    /**
     * Creates a form to delete a tblcalificacion entity.
     *
     * @param Tblcalificacion $tblcalificacion The tblcalificacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tblcalificacion $tblcalificacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblcalificacion_delete', array('id' => $tblcalificacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
