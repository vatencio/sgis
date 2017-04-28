<?php

namespace Vatencio\SgisBundle\Form\Mostrar;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\AbstractType;
class RegistrationFormPerfilMostrarType extends AbstractType
{

	
    public function buildForm(FormBuilderInterface $builder, array $options)     {
        parent::buildForm($builder, $options);
        
        $builder
       // ->add('roles', 'choice', array('label' => 'Rol', 'required' => true, 'choices' => array( 1 => 'ROLE_ADMIN', 2 => 'ROLE_USER'), 'multiple' => true))
       //  ->add('roles', 'role_admin', array(
       //     'label' => 'Rol', 'required' => true,'multiple' => true
       // ))
        ->add('email', null, array(
           'label' => 'form.email', 'translation_domain' => 'FOSUserBundle','attr'=>array('disabled'=>true)
        ))
        //->add('email','hidden')          
        ->add('username', null, array(
           'label' => 'form.username', 'translation_domain' => 'FOSUserBundle','attr'=>array('disabled'=>true)
        ))
        //->add('username','hidden')        
       // ->add('empresaCliente')
       // ->add('fechaCr','hidden',array('data_class'=>'DateTime'))
       // ->add('usuarioCr','hidden')
      //  ->add('fechaUd','hidden',array('data_class'=>'DateTime'))
      //  ->add('usuarioUd','hidden')          
                ;
    }
	
	public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getName() {
        return 'mi_user_registration';
    }
}