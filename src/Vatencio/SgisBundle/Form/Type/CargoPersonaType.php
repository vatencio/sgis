<?php

// src/Acme/DemoBundle/Form/Type/GenderType.php
namespace Rht\RhtOnlineBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class CargoPersonaType extends AbstractType
{
    private $entityManager;
    private $securityContext;

    public function __construct(SecurityContext $securityContext,  EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->securityContext = $securityContext;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        
        $r_admin=$this->securityContext->isGranted('ROLE_ADMIN');
        $r_empresa=$this->securityContext->isGranted('ROLE_CLIENTE');
        $id_usu=$this->securityContext->getToken()->getUser()->getId();
        $arr_ep=array();
         
        if(!$r_admin){
           /* if($r_empresa){
                $idEmpresaCliente=$this->entityManager->getRepository('RhtRhtOnlineBundle:SguCargoPersona')->findIdCargoByIdUsuario($id_usu);
            }*/
           // if(!$r_empresa){
                $idEmpresaCliente = $this->securityContext->getToken()->getUser()->getSucursal()->getEmpresaCliente()->getId();
           // }    
                $arr_empresa_persona= $this->entityManager
                ->createQuery('SELECT c.id,c.nombre FROM RhtRhtOnlineBundle:SguCargoEmpresaCliente ce JOIN ce.cargo c JOIN ce.empresaCliente ec WHERE ec.id = :empresacliente_id ')
                ->setParameter('empresacliente_id', $idEmpresaCliente)
                ->getArrayResult();
                foreach($arr_empresa_persona as $llave => $value){
                    $arr_ep[$value['id']]=$value['nombre'];
                }
               
                $resolver->setDefaults(array(
                    'choices' => $arr_ep,
                ));
               
            
        }else{
            $arr_empresa_persona= $this->entityManager
                ->createQuery('SELECT c.id,c.nombre FROM RhtRhtOnlineBundle:SguCargoEmpresaCliente ce JOIN ce.cargo c ')
               
                ->getArrayResult();
                foreach($arr_empresa_persona as $llave => $value){
                    $arr_ep[$value['id']]=$value['nombre'];
                }
               
                $resolver->setDefaults(array(
                    'choices' => $arr_ep,
                ));
        }
       
    }
   /* public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                1 => 'ROLE_ADMIN',
                2 => 'ROLE_CLIENTE',
                3 => 'ROL_EVALUADO'
            )
        ));
    }*/

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'cargo_persona';
    }
}
?>
