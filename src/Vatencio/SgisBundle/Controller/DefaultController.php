<?php

namespace Vatencio\SgisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vatencio\SgisBundle\Form\Mostrar\SguPersonaMostrarType;
use Symfony\Component\HttpFoundation\Response;
use Vatencio\SgisBundle\Lib\ValidarEmail;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $id_usu = $this->get('security.token_storage')->getToken()->getUser()->getId();
       //$rol_usu = $em->getRepository('RhtRhtOnlineBundle:SguRolUsuario')->findOneBy(array('usuario_id' => $id_usu));
        // primero se haya el usuario
        $docente = $this->getDoctrine()->getRepository('VatencioSgisBundle:Tbldocente')->findByIntidfosuser($id_usu);
        //var_dump($docente);
        $rol_usu = $this->getDoctrine()->getRepository('VatencioSgisBundle:Tblroledocente')->findByIntiddocente($docente[0]->getIntiddocente());
        //$rol = $this->getDoctrine()->getRepository('VatencioSgisBundle:Tblrole')->findByIntiddocente($rol_usu[0]->getIntidrol());
        $permisos_usu = $this->getDoctrine()->getRepository('VatencioSgisBundle:Tblpermiso')->findByIntidrole($rol_usu[0]->getIntidrol());
        //Obtengo la persona relacionada con ese usuario (Debe ser usuario de persona, no sirve si el usuario es de empresa)
        //$persona_usu = $this->getDoctrine()->getRepository('VatencioSgisBundle:Tblpersona')->findPersonaByIdUsuario($id_usu);
        $persona_usu = $docente[0]->getIntidpersona();
        //Valida el rol para definir que plantilla cargar
        //  var_dump($docente[0]->getIntidpersona());
        return $this->render('VatencioSgisBundle:Default:index.html.twig', array(
                "permisos_menu" => $permisos_usu,            
                "persona_usu"=>$docente[0],               
        ));            
      
    }
    // Prueba de envío de correos
    public function showSendMailAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('RhtRhtOnlineBundle:SguArea')->findAll();
        
        $is_admin = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
        $is_cliente = $this->get('security.authorization_checker')->isGranted('ROLE_CLIENTE');
        $id_usu = $this->get('security.token_storage')->getToken()->getUser()->getId();
               
        $em = $this->getDoctrine()->getManager();
        //Se cargan los datos que se van a mostrar en la vista segun el rol del usuario
        if($is_admin){
            $UsrEntities = $em->getRepository('VatencioSgisBundle:SguPersona')->findPersonaEvaluado();
           // var_dump($UsrEntities[0]['persona']);exit;
            $PruEntities = null;
            $EmpCliEntities = $em->getRepository('VatencioSgisBundle:SguEmpresaCliente')->findAll();            
            $SucEntities = null;
            $usrClienteEntities = null;
            $CargoEntities = null;
            $empEntities = null;             
        }            
        else if($is_cliente){
            $empresa_cliente_id = $this->get('security.token_storage')->getToken()->getUser()->getSucursal()->getEmpresaCliente()->getId();
            $sucursal_id = $this->get('security.token_storage')->getToken()->getUser()->getSucursal()->getId();
            $UsrEntities = $em->getRepository('VatencioSgisBundle:SguPersona')->findPersonaEvaluadoByIdSucursal($sucursal_id);
            $PruEntities = $em->getRepository('VatencioSgisBundle:SguUsuarioPrueba')->findByUsuario($id_usu);
            $EmpCliEntities = $this->get('security.token_storage')->getToken()->getUser()->getSucursal()->getEmpresaCliente()->getRazonComercial();
            $SucEntities = null;
            $usrClienteEntities = null;
            $CargoEntities = $em->getRepository('VatencioSgisBundle:SguCargoEmpresaCliente')->findByEmpresaCliente($empresa_cliente_id);
            $empEntities = $em->getRepository('VatencioSgisBundle:SguEmpresaPersona')->findByEmpresaCliente($empresa_cliente_id);
        }
        return $this->render('VatencioSgisBundle:Default:showSendMail.html.twig', array(
            'titulo' => 'Enviar Correos',
            'usuarios' => $UsrEntities,
            'pruebas' => $PruEntities,
            'clientes' => $EmpCliEntities,
            'sucursales' => $SucEntities,
            'usuarios_clientes' => $usrClienteEntities,
            'cargos' => $CargoEntities,
            'empresas' => $empEntities,
            'admin' => $is_admin,
        ));

       /* return $this->render('RhtRhtOnlineBundle:Default:showSendMail.html.twig', array(
            'empresa' => "Falders Chip Asociados",
        ));*/
    }
    public function messageSendMailAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('RhtRhtOnlineBundle:SguArea')->findAll();

        return $this->render('VatencioSgisBundle:Default:messageSendMail.html.twig', array(
            'mensaje' => "Está seguro, desea continuar?",
        ));
    }
    public function sendMailAction($usuarios,$correos,$id_usu,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $usuarios = (explode(',',$usuarios));
        $correos = (explode(',',$correos));
        $id_usu = (explode(',',$id_usu));
        
        // Obtengo el mensaje enviado por el data de ajax
        $arr_mensaje = $request->request->all();
        //var_dump($arr_mensaje);exit;
        $mensaje = $arr_mensaje['mensaje'];
        
        $i = 0;
        $errores = "";
        $errores_sintaxis = "";
        $enviados = 0;
        
        foreach ($usuarios as $u){
            //Obtengo el usuario por medio del id de la persona
            $entity = $em->getRepository('VatencioSgisBundle:SguUsuario')->findPersonaByIdUsuario($id_usu[$i]);
            // Para los evaluados la clave es el mismo usuario
            $usuario_clave = $entity[0]->getUsuario()->getUsername();
            //Se sustituye el usuario y la clave en el mensaje
            $arr_reemplazar = array('{usuario}','{clave}');
            $mensaje = str_replace($arr_reemplazar, $usuario_clave, $mensaje);
            
            $view = $this->render('VatencioSgisBundle:Default:sendMail.html.twig', array(
                        'nombre' => $u,
                        'mensaje' => $mensaje,
                    ));
            
            $is_admin = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');

            $ValEmail = new ValidarEmail();
            $arr = array('citaciones@rhtconsultores.net' => 'Citaciones');
            
            if(!$is_admin){
                $empresa_cliente = $this->get('security.token_storage')->getToken()->getUser()->getSucursal()->getEmpresaCliente()->getId();
                $entities = $em->getRepository('VatencioSgisBundle:SguEmpresaCliente')->find($empresa_cliente);
                $correo = trim($entities->getCorreoSalida());
                $razonComercial = trim($entities->getRazonComercial());
                if($correo === "")
                {
                    $correo = 'citaciones@rhtconsultores.net';
                }
                if($razonComercial === "")
                {
                    $razonComercial = 'Citaciones';
                }
                $arr = array($correo => $razonComercial); 
            }
            //var_dump($view->getContent());exit;
            $message = \Swift_Message::newInstance()
                ->setSubject('Citacion')
                ->setFrom($arr)
                ->setTo('maciasatencio@hotmail.com')
                ->setBody($view->getContent(), 'text/html')    
            ;
            $em_val = $ValEmail->ValidarEmail($correos[$i]);
            //var_dump($em_val);exit;
            if($em_val){
                
                $html = $this->get('mailer')->send($message, $failedRecipients);
                $enviados += $html;
                if($failedRecipients){
                    $errores .= $failedRecipients;
                }
                else{
                    $estado_envio = (int)$entity[0]->getEmailEnviado();
                    //var_dump($estado_envio);exit;
                    if($estado_envio == 0){
                        $entity[0]->setEmailEnviado(1);
                    }
                    else{
                        $entity[0]->setEmailEnviado($estado_envio+1);
                    }
                }
            }
            else{
                $errores_sintaxis .= $correos[$i];
            }
            $em->flush();
        $i++;    
        }
        if($enviados == count($usuarios)){
            return new Response(json_encode(array("html" => "Todos los correos fueron enviados","fail" =>"","valid" => true)));
        }
        else{
            return new Response(json_encode(array("html" => "Los siguientes correos no fueron enviados $errores","fail" =>$errores_sintaxis ,"valid" => false)));
        }
    }
    
}
?>