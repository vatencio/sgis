<?php

namespace Vatencio\SgisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TbldocenteinstitucionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dtmcreacion')->add('strcreacion')->add('dtmactualizacion')->add('stractualizacion')->add('intiddocente')->add('intidinstitucion')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vatencio\SgisBundle\Entity\Tbldocenteinstitucion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'vatencio_sgisbundle_tbldocenteinstitucion';
    }


}
