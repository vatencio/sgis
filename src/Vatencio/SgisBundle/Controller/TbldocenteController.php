<?php

namespace Vatencio\SgisBundle\Controller;

use Vatencio\SgisBundle\Entity\Tbldocente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vatencio\SgisBundle\Form\Mostrar\SguDocentePersonaUsuarioPerfilMostrarType;
/**
 * Tbldocente controller.
 *
 */
class TbldocenteController extends Controller
{
    /**
     * Lists all tbldocente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tbldocentes = $em->getRepository('VatencioSgisBundle:Tbldocente')->findAll();

        return $this->render('tbldocente/index.html.twig', array(
            'tbldocentes' => $tbldocentes,
        ));
    }

    /**
     * Creates a new tbldocente entity.
     *
     */
    public function newAction(Request $request)
    {
        $tbldocente = new Tbldocente();
        $form = $this->createForm('Vatencio\SgisBundle\Form\TbldocenteType', $tbldocente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tbldocente);
            $em->flush($tbldocente);

            return $this->redirectToRoute('tbldocente_show', array('id' => $tbldocente->getIntiddocente()));
        }

        return $this->render('tbldocente/new.html.twig', array(
            'tbldocente' => $tbldocente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tbldocente entity.
     *
     */
    public function showAction(Tbldocente $tbldocente)
    {
        $deleteForm = $this->createDeleteForm($tbldocente);

        return $this->render('tbldocente/show.html.twig', array(
            'tbldocente' => $tbldocente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tbldocente entity.
     *
     */
    public function editAction(Request $request, Tbldocente $tbldocente)
    {
        $deleteForm = $this->createDeleteForm($tbldocente);
        $editForm = $this->createForm('Vatencio\SgisBundle\Form\TbldocenteType', $tbldocente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tbldocente_edit', array('id' => $tbldocente->getIntiddocente()));
        }

        return $this->render('tbldocente/edit.html.twig', array(
            'tbldocente' => $tbldocente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tbldocente entity.
     *
     */
    public function deleteAction(Request $request, Tbldocente $tbldocente)
    {
        $form = $this->createDeleteForm($tbldocente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tbldocente);
            $em->flush($tbldocente);
        }

        return $this->redirectToRoute('tbldocente_index');
    }

    /**
     * Creates a form to delete a tbldocente entity.
     *
     * @param Tbldocente $tbldocente The tbldocente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tbldocente $tbldocente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tbldocente_delete', array('id' => $tbldocente->getIntiddocente())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Edita los perfiles, es decir, el usuario que está logueado.
     *
     */
    public function editPerfilAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('VatencioSgisBundle:Tblpersona')->find($id);
       // $entity1 = $em->getRepository('VatencioSgisBundle:Tblusuario')->find($entity->getIntidfosuser()->getId());
        $entity1 = $em->getRepository('VatencioSgisBundle:Tbldocente')->findByIntidpersona($id);   
        //$entity->setUsuario($entity1);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SguPersona entity.');
        }
        
       // $editForm = $this->createForm(SguPersonaUsuarioPerfilMostrarType::class, $entity);
        $editForm = $this->createForm(SguDocentePersonaUsuarioPerfilMostrarType::class, $entity1[0]);
        $deleteForm = $this->createDeleteForm($entity1[0]);

        return $this->render('VatencioSgisBundle:Tbldocente:editPerfil.html.twig', array(
            'entity'      => $entity1[0],
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Edita el perfil. es decir el usuario que está logueado en el momento
     *
     */
    public function updatePerfilAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        //var_dump($request->request);exit;
        //Obtengo el id del usuario
        $id_usu=$this->get('security.context')->getToken()->getUser()->getId();
        $dm=new DatosManipulacion();
       // var_dump($request);exit;
        //obtengo el nombre del form
        $Form=new SguPersonaUsuarioType();
        $nombreForm=$Form->getName();
        $entity = $em->getRepository('RhtRhtOnlineBundle:SguPersona')->find($id);
        $entity1 = $em->getRepository('RhtRhtOnlineBundle:SguUsuario')->find($entity->getUsuario()->getId());
        $entity->setUsuario($entity1);
        //var_dump($entity->getUsuario()->getRoleUsuario());exit;
        $request = $dm->DatosManipulacion($request, "Actualizar", $nombreForm, $id_usu,$entity);
        // Agrego los campos adicionales para el fromulario de usuario
            $parametros = $request->request->get($nombreForm);
            $parametros['usuario' ]= array_merge($parametros['usuario'],array('usuarioCr'=>$entity->getUsuario()->getUsuarioCr(),'fechaCr'=>$entity->getUsuario()->getFechaCr(),'fechaUd'=> new \DateTime(),'usuarioUd'=>$id_usu));
            $parametros['usuario'] = array_merge($parametros['usuario'],array('email'=>$entity->getUsuario()->getEmail(),'roles'=>$entity->getUsuario()->getRoleUsuario()));
            $request->request->set($nombreForm,$parametros);
        //
        // Agrego los campos adicionales para el fromulario de persona
            $parametros = $request->request->get($nombreForm);
            $parametros = array_merge($parametros,array('primerNombre'=>$entity->getPrimerNombre(),'primerApellido'=>$entity->getPrimerApellido(),'tipoDocumento'=>$entity->getTipoDocumento()->getId(),'numeroIdentificacion'=>$entity->getNumeroIdentificacion(),'empresaPersona'=>$entity->getEmpresaPersona()->getId()));
            
            $request->request->set($nombreForm,$parametros);
        //
        //var_dump($request->request);exit;
            
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SguPersona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SguPersonaUsuarioPerfilType(), $entity);
        $editForm->bind($request);
        //var_dump($request->request);exit;
        $valid = $editForm->isValid();
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

           // return $this->redirect($this->generateUrl('sgupersona_edit', array('id' => $id)));
            
            //var_dump($html->getContent());exit;
            return new Response(json_encode(array("html" => "","valid" => $valid,"id" => $entity->getId())));
        }
        else{
            // Se debe pintar nuevamente el formulario del new, por eso se crea un nuevo form
            // Con el de mostrar para evitar que arroje algún error
            $editForm = $this->createForm(new SguPersonaUsuarioPerfilMostrarType(), $entity);
            // Llamo al metodo que elimina los campos adicionales, este sólo funciona para el formulario principal
            $request=$dm->DeleteDatosManipulacion($request, $nombreForm);
            // Elimino los campos adicionales para usuario
            // Para que no genere error al mostrar nuevamente el formulario
                $parametros=$request->request->get($nombreForm);
                unset($parametros['usuario']['roles'],$parametros['usuario']['fechaCr'],$parametros['usuario']['usuarioCr'],$parametros['usuario']['fechaUd'],$parametros['usuario']['usuarioUd']);
                //unset($parametros['primerNombre'],$parametros['primerApellido'],$parametros['tipoDocumento'],$parametros['numeroIdentificacion'],$parametros['empresaPersona']);
                $request->request->set($nombreForm,$parametros);
            //
            $editForm->bind($request);
        }
        
        $html = $this->render('RhtRhtOnlineBundle:SguPersona:editPerfil.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
            //var_dump($html->getContent());exit;
            return new Response(json_encode(array("html" => $html->getContent(),"valid" => $valid)));
    }
}
