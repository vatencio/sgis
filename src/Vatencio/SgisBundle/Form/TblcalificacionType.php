<?php

namespace Vatencio\SgisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TblcalificacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('strnombre',null,array(
                    'attr'=>array('disabled'=>false),
                    'label' => 'Nombre'
                ))
                ->add('strdescripcion',null,array(
                    'attr'=>array('disabled'=>false),
                    'label' => 'Descripcion'
                ))
                ->add('intiddocente',null,array(
                    'attr'=>array('disabled'=>false),
                    'label' => 'Docente'
                ))
                ->add('intidlogro',null,array(
                    'attr'=>array('disabled'=>false),
                    'label' => 'Logro'
                ))
                ->add('intidmateriaestudiante',null,array(
                    'attr'=>array('disabled'=>false),
                    'label' => 'Materia-Estidiante'
                ))
                ->add('intidnota',null,array(
                    'attr'=>array('disabled'=>false),
                    'label' => 'Nota'
                ))
                ->add('intidperiodoyear',null,array(
                    'attr'=>array('disabled'=>false),
                    'label' => 'Periodo-Año'
                ))        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vatencio\SgisBundle\Entity\Tblcalificacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'vatencio_sgisbundle_tblcalificacion';
    }
    
    public function getName()
    {
        return getBlockPrefix();
    }


}
