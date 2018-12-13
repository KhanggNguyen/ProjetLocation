<?php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use UM2\PlatformBundle\Entity\Services;
use UM2\PlatformBundle\Form\PlagesHoraireType;

class ServicesEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
                ->add('prix', NumberType::class)
                ->add('descriptif')
                ->add('lieu')
                ->add('plageshoraire', CollectionType::class , array(
                    'entry_type' => PlagesHoraireType::class,
                    'allow_add' => true,
                    'prototype' => true,
                    'by_reference' => false));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UM2\PlatformBundle\Entity\Services'
        ));
    }

    public function getBlockPrefix()
    {
        return 'um2_platformbundle_services';
    }

    public function getName(){
        return $this->getBlockPrefix();
    }
}
