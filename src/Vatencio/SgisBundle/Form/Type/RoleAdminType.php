<?php

// src/Acme/DemoBundle/Form/Type/GenderType.php
namespace Rht\RhtOnlineBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class RoleAdminType extends AbstractType
{
    private $roleChoicesAdmin;
    private $roleChoicesEmpresa;
    private $securityContext;

    public function __construct(array $roleChoicesAdmin,array $roleChoicesEmpresa,SecurityContext $securityContext)
    {
        $this->roleChoicesAdmin = $roleChoicesAdmin;
        $this->roleChoicesEmpresa = $roleChoicesEmpresa;
        $this->securityContext = $securityContext;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        //$user = $this->securityContext->getToken()->getUser();
        $r_admin=$this->securityContext->isGranted('ROLE_ADMIN');
        //$r_empresa=$this->securityContext->isGranted('ROLE_CLIENTE');
        if($r_admin){
            $resolver->setDefaults(array(
                'choices' => $this->roleChoicesAdmin,
            ));
        }//elseif($r_empresa){
        // se cambia porque realmente puede sercualquier otro role, diferenta a admin
        else{
            $resolver->setDefaults(array(
                'choices' => $this->roleChoicesEmpresa,
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
        return 'role_admin';
    }
}
?>
