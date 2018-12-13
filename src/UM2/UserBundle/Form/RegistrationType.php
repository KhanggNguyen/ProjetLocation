<?php
// src/UserBundle/Form/RegistrationType.php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use UM2\UserBundle\Entity\User;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username')
        	->add('email')
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class)
        	->add('adresse')
            ->add('dateNaissance', BirthdayType::class)
        	->add('ville')
        	->add('telephone');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'UM2\UserBundle\Entity\User',
        ]);
    }

    public function getBlockPrefix()
   	{
    	return 'app_user_registration';
   	}
 
   	public function getName()
   	{
    	return $this->getBlockPrefix();
    }
}