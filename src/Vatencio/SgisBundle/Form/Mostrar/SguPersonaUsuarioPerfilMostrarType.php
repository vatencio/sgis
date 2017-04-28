<?php

namespace Vatencio\SgisBundle\Form\Mostrar;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vatencio\SgisBundle\Form\Mostrar\RegistrationFormPerfilMostrarType;
use Vatencio\SgisBundle\Form\Type\SexoType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SguPersonaUsuarioPerfilMostrarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('usuario', new RegistrationFormPerfilMostrarType('Vatencio\SgisBundle\Entity\Tblusuario'))
           // ->add('primerNombre','hidden')  
            ->add('strprimernombre',null,array(
                'attr'=>array('disabled'=>true),
				'label' => 'Primer Nombre'
            ))
            //->add('segundoNombre','hidden')    
            ->add('strsegundonombre',null,array(
                'attr'=>array('disabled'=>true),
				'label' => 'Segundo Nombre'
            ))
            //->add('primerApellido','hidden')   
            ->add('strprimerapellido',null,array(
                'attr'=>array('disabled'=>true),
				'label' => 'Primer Apellido'
            ))
            //->add('segundoApellido','hidden')      
            ->add('strsegundoapellido',null,array(
                'attr'=>array('disabled'=>true),
				'label' => 'Segundo Apellido'
            ))
            
            ->add('strsexo',  SexoType::class, array(
                'label' => 'Sexo', 'required' => true,'multiple' => false,
				'attr' => array('disabled'=>true,
					'placeholder' => 'Seleccione un opcion'
                )
            ))
            //->add('tipoDocumento','hidden',array(
            //    'data_class'=> 'Rht\RhtOnlineBundle\Entity\SisTipoDocumento'
            //))     
           // ->add('intidtipodocumento',null,array(
           //     'attr'=>array('disabled'=>true
			//	,'placeholder' => 'Seleccione un opcion'),
                
            //))
            //->add('numeroIdentificacion','hidden')      
            ->add('strnodocumento',null,array(
                'attr'=>array('disabled'=>true),
				'label' => 'Numero de Documento'
            ))
               
            ->add("dtmfechanacimiento", DateType::class, array(
                'widget' => 'choice',
                'years' => range(date('Y')-70,date('Y')-18),
				'attr'=>array('disabled'=>true),
				'label' => 'Fecha de nacimiento'
            ))     
            //->add('empresaPersona','hidden',array(
            //    'data_class'=> 'Rht\RhtOnlineBundle\Entity\SguEmpresaPersona'
            //))                                  
            //->add('empresaPersona',null,array(
            //    'attr'=>array('disabled'=>true
			//	,'placeholder' => 'Seleccione un opcion'),
            //))
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vatencio\SgisBundle\Entity\Tblpersona',
            'csrf_protection' => false,
            'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'vatencio_sgisbundle_sgupersonausuariotype';
    }
}
