<?php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use UM2\PlatformBundle\Entity\PlagesHoraire;

class PlagesHoraireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateService',DateType::class, array(
                'widget' => 'choice',))
            ->add('heuredebut', TimeType::class, array(
                'input' => 'datetime',
                'widget' => 'choice'))
            ->add('heurefin', TimeType::class, array(
                'input' => 'datetime',
                'widget' => 'choice'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UM2\PlatformBundle\Entity\PlagesHoraire'
        ));
    }

    public function getBlockPrefix()
    {
        return 'um2_platformbundle_plageshoraire';
    }

    public function getName(){
        return $this->getBlockPrefix();
    }
}
