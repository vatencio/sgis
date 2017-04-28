<?php

// src/Acme/DemoBundle/Form/Type/GenderType.php
namespace Rht\RhtOnlineBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EmpresaPersonaType extends AbstractType
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
            
                $idEmpresaCliente = $this->securityContext->getToken()->getUser()->getSucursal()->getEmpresaCliente()->getId();
               
                $arr_empresa_persona= $this->entityManager
                ->createQuery('SELECT p.id,p.nombre FROM RhtRhtOnlineBundle:SguEmpresaPersona p JOIN p.empresaCliente c WHERE c.id = :empresacliente_id ')
                ->setParameter('empresacliente_id', $idEmpresaCliente)
                ->getArrayResult();
                foreach($arr_empresa_persona as $llave => $value){
                    $arr_ep[$value['id']]=$value['nombre'];
                }
               
                $resolver->setDefaults(array(
                    'choices' => $arr_ep,
                ));
               
            
        }//elseif($r_empresa){
        // se cambia porque realmente puede sercualquier otro role, diferenta a admin
       
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
        return 'empresa_persona';
    }
}
?>
