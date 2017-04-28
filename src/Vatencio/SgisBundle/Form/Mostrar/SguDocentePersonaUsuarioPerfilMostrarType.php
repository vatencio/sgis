<?php

namespace Vatencio\SgisBundle\Form\Mostrar;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vatencio\SgisBundle\Form\Mostrar\RegistrationFormPerfilMostrarType;
use Vatencio\SgisBundle\Form\Type\SexoType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SguDocentePersonaUsuarioPerfilMostrarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       // var_dump("4");
        $builder
		   // ->add('intidfosuser', RegistrationFormPerfilMostrarType::class)
		   //->add('intidfosuser', new RegistrationFormPerfilMostrarType('Vatencio\SgisBundle\Entity\Tblusuario'))
            ->add('intidpersona', SguPersonaUsuarioPerfilMostrarType::class,array(
                'attr'=>array('disabled'=>true),
				'label' => '_____________________________________________________________________'
            ))
           // ->add('primerNombre','hidden')  
            ->add('strespecialidad',null,array(
                'attr'=>array('disabled'=>true),
				'label' => 'Especialidad'
            ))
            //->add('segundoNombre','hidden')    
                 
            //->add('empresaPersona','hidden',array(
            //    'data_class'=> 'Rht\RhtOnlineBundle\Entity\SguEmpresaPersona'
            //))                                  
            //->add('empresaPersona',null,array(
            //    'attr'=>array('disabled'=>true
			//	,'placeholder' => 'Seleccione un opcion'),
            //))
                
        ;
      //  var_dump("5");
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vatencio\SgisBundle\Entity\Tbldocente',
            'csrf_protection' => false,
            'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'vatencio_sgisbundle_sgupersonausuariotype';
    }
}
