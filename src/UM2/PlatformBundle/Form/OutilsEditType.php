<?php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use UM2\PlatformBundle\Form\ImageType;
use UM2\PlatformBundle\Entity\Outils;

class OutilsEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
                ->add('prixNeuf', NumberType::class)
                ->add('lieu')
                ->add('garantie')
                ->add('image', ImageType::class, ['required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UM2\PlatformBundle\Entity\Outils'
        ));
    }

    public function getBlockPrefix()
    {
        return 'um2_platformbundle_outils';
    }

    public function getName(){
        return $this->getBlockPrefix();
    }
}
