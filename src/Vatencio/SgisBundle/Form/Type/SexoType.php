<?php

// src/Acme/DemoBundle/Form/Type/GenderType.php
namespace Vatencio\SgisBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
//use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
//use Symfony\Component\Security\Core\SecurityContext;

class SexoType extends AbstractType
{
    private $choicesSexo;

    public function __construct(array $choicesSexo)
    {
        $this->choicesSexo = $choicesSexo;
    }

    /*public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
            $resolver->setDefaults(array(
                'choices' => $this->choicesSexo,
            ));
        
    }*/
	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => $this->choicesSexo,
        ));
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
        return ChoiceType::class;
    }
}
?>
