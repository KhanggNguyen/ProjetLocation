<?php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use UM2\UserBundle\Entity\User;
use UM2\UserBundle\Form\RegistrationType;
use UM2\UserBundle\Form\LoginType;

class SecurityController extends Controller
{
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $routeName = $request->get('_route');
        $auth_checker = $this->get('security.authorization_checker');
        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();

        if($routeName == 'um2_user_edit'){
            if(!$auth_checker->isGranted('IS_AUTHENTICATED_REMEMBERED')){
                return $this->redirectToRoute("um2_user_login");
            }
        }

        if($routeName == 'um2_user_register'){
            if($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
                return $this->redirectToRoute('um2_user_edit');
            }
            $user = new User();
        }
        $form = $this->createForm(RegistrationType::class, $user);

    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid())
    	{
    		$hash = $passwordEncoder->encodePassword($user, $user->getPassword()); //on a décidé l'algorithme à utiliser par encoder est bcrypt dans security.yml
    		$user->setPassword($hash);
    		$manager=$this->getDoctrine()->getManager();
    		$manager->persist($user);
    		$manager->flush();

            return $this->redirectToRoute("um2_core_home");
    	}

    	return $this->render('UM2UserBundle:Security:register.html.twig', [
    		'form' => $form->createView(),
    		'editMode' => $user->getId()!== null
    	]);
    }

    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        $auth_checker = $this->get('security.authorization_checker');
        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();

        if($auth_checker->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirectToRoute("um2_user_view", ['id' => $user->getId()]);
        }
        
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        //if($error instanceof AccountStatusException )
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();        

        return $this->render('UM2UserBundle:Security:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
        
    	return $this->render('UM2UserBundle:Security:login.html.twig');
    }

    public function logoutAction(){}

    public function resetAction()
    {
        
    }


}
