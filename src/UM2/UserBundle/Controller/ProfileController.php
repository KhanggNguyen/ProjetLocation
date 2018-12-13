<?php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use UM2\UserBundle\Entity\User;

class ProfileController extends Controller
{
	public function viewAction(User $user){
		return $this->render('UM2UserBundle:Profile:view.html.twig', array(
			'user' => $user
		));
	}

	public function activateAction(User $user){
		$auth_checker = $this->get('security.authorization_checker');
        if(!$auth_checker->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute("um2_core_home");
        }

        if(!$user){
        	return $this->redirectToRoute("um2_core_home");
        }
        if($user->getEstActive()){
        	$user->setEstActive(false);
        }else{
        	$user->setEstActive(true);
        }

        return $this->render('UM2UserBundle:Profile:view.html.twig', [
            'user' => $user,
        ]); 
	}

    public function commandeAction(){
        $auth_checker = $this->get('security.authorization_checker');
        if(!$auth_checker->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirectToRoute("um2_core_home");
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $listOutilsByUser = $this->getDoctrine()
            ->getManager()
            ->getRepository('UM2PlatformBundle:OutilsUser')
            ->findByUser($user->getId());

        $listOutils = $this->getDoctrine()
            ->getManager()
            ->getRepository('UM2PlatformBundle:Outils')
            ->findAll();

        $listServicesByUser = $this->getDoctrine()
            ->getManager()
            ->getRepository('UM2PlatformBundle:ServicesUser')
            ->findByUser($user->getId());

        $listServices = $this->getDoctrine()
            ->getManager()
            ->getRepository('UM2PlatformBundle:Services')
            ->findAll();

        return $this->render('UM2UserBundle:Profile:mesCommandes.html.twig', [
            'user' => $user,
            'listServicesUser' => $listServicesByUser,
            'listOutilsUser' => $listOutilsByUser,
            'listOutils' => $listOutils,
            'listServices' => $listServices,
        ]); 

    }
}