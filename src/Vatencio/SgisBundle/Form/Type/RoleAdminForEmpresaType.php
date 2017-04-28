<?php

// src/Acme/DemoBundle/Form/Type/GenderType.php
namespace Rht\RhtOnlineBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class RoleAdminForEmpresaType extends AbstractType
{
    private $roleChoicesAdminForEmpresa;

    public function __construct(array $roleChoicesAdminForEmpresa)
    {
        $this->roleChoicesAdminForEmpresa = $roleChoicesAdminForEmpresa;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        
        $resolver->setDefaults(array(
            'choices' => $this->roleChoicesAdminForEmpresa,
        ));
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'role_admin_for_empresa';
    }
}
?>
