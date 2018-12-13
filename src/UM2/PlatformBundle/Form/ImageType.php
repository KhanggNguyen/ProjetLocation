<?php
// src/OC/PlatformBundle/Form/ImageType.php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\PlatformBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use UM2\PlatformBundle\Entity\Image;

class ImageType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('file', FileType::class)
    ;
  }
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'UM2\PlatformBundle\Entity\Image'
    ));
  }

  public function getBlockPrefix()
  {
    return 'um2_platformbundle_image';
  }

  public function getName(){
    return $this->getBlockPrefix();
  }
}