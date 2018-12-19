<?php
//auteur : Huu Khang NGUYEN - Hoai Nam NGUYEN
namespace UM2\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

use UM2\PlatformBundle\Entity\Services;
use UM2\PlatformBundle\Entity\ServicesUser;
use UM2\PlatformBundle\Entity\PlagesHoraire;
use UM2\PlatformBundle\Form\ServicesType;
use UM2\PlatformBundle\Form\ServicesEditType;
use UM2\PlatformBundle\Repository\ServicesRepository;

class ServicesController extends Controller
{	
	public function viewAction(Services $services = null)
    {   
    	return $this->render('UM2PlatformBundle:Services:view.html.twig', array(
        	'service' => $services,
        ));
    }

    public function indexAction($page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $nbPerPage = $this->container->getParameter('nbPerPage');

        $listServices = $this->getDoctrine()
            ->getManager()
            ->getRepository('UM2PlatformBundle:Services')
            ->findByPage($page,$nbPerPage);

        $nbPages = ceil(count($listServices) / $nbPerPage);

        return $this->render('UM2PlatformBundle:Services:index.html.twig', array(
            'listServices' => $listServices,
            'nbPages'     => $nbPages,
            'page'        => $page,
        ));
    }

    public function showListServicesAction($page, $nbPerPage = null){
        $auth_checker = $this->get('security.authorization_checker');
        if(!$auth_checker->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirectToRoute("um2_user_login");
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        if(!$page){
            $nbPerPage = $this->container->getParameter('nbPerPage');   
        }

        $listServices = $this->getDoctrine()
            ->getManager()
            ->getRepository('UM2PlatformBundle:Services')
            ->findByVendeur($user->getId(),$page,$nbPerPage);

        $nbPages = ceil(count($listServices) / $nbPerPage);

        return $this->render('UM2PlatformBundle:Services:myservices.html.twig', array(
            'listServices' => $listServices,
            'nbPages'     => $nbPages,
            'page'        => $page,
        ));
    }

    /**
	  * @Route("/service/rent/{idService}/{idHoraire}")
	  *
	  * @ParamConverter("service", options={"mapping": {"idService" : "id"}})
  	  * @ParamConverter("horaire", options={"mapping": {"idHoraire" : "id"}})
	  */
    public function rentAction(Services $service, PlagesHoraire $horaire = null){
        $auth_checker = $this->get('security.authorization_checker');
        if(!$auth_checker->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
            return $this->redirectToRoute("um2_user_login");
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($service->getVendeur()->getId() == $user->getId())
        {
            return $this->redirectToRoute('um2_service_view', ['id' => $service->getId()]);
        }
        try{
        	$serviceUser = new ServicesUser();
	        $serviceUser->setDate();
	        $serviceUser->setService($service);
	        $serviceUser->setUser($user);
	        $serviceUser->setHoraire($horaire);
	        $horaire->setEstLoue(true);
	        $user->setCagnote();//incrémenter cagnote par 1
	        $manager=$this->getDoctrine()->getManager();
	        $manager->persist($serviceUser);
	        $manager->persist($user);
	        $manager->flush();
	        $this->get('session')->getFlashBag()->add(
        	'notice',
        	'Louer succès!'
    		);

        }catch(\Doctrine\ORM\ORMException $e){
        	$this->get('session')->getFlashBag()->add('error', 'Vous avez loué ce service');
        	$this->get('logger')->error($e->getMessage());
        }
        
        return $this->redirectToRoute('um2_service_view', ['id' => $service->getId()]);
        
        
    }

    public function addAction(Services $service = null, Request $request)
    {
    	$auth_checker = $this->get('security.authorization_checker');
        if(!$auth_checker->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirectToRoute("um2_user_login");
        }

        if(!$service)
        {
            $service = new Services();
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();


        $routeName = $request->get('_route');
        if($routeName == 'um2_service_edit'){
            if(!$service->getVendeur()->getId() == $user->getId()){
                return $this->redirectToRoute('um2_service_view', ['id' => $service->getId()]);
            }
            $listTaxonomies = $this->getDoctrine()
                ->getManager()
                ->getRepository('UM2PlatformBundle:OutilsTaxonomie')
                ->findByOutil($outil);
            $listMotsCles = array();
            foreach($listTaxonomies as $taxonomie){
                array_push($listMotsCles,$taxonomie->getMotcle()->getMotcle());
                $em = $this->getDoctrine()->getManager();
                $em->remove($taxonomie);
            }

            $motsCles = implode(" ", $listMotsCles);

            $form = $this->createForm(ServicesEditType::class, $service);
        }else{
            $form = $this->createForm(ServicesType::class, $service);
        }

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!$service->getId()){
                $service->setDate();
            }
            $manager=$this->getDoctrine()->getManager();

            $listMotsCles = $request->get('motscles');
            $array_listMotsCles = explode(" ", $listMotsCles);
            foreach($array_listMotsCles as $mot){
                $mot_temp = new Taxonomie();
                $mot_temp->setMotCle($mot);
                $mot_temp->setType('Service');
                $manager->persist($mot_temp);

                $motOutil = new OutilsTaxonomie();
                $motOutil->setOutil($outil);
                $motOutil->setMotcle($mot_temp);
                $manager->persist($motOutil);
            }

            $plageshoraire = $service->getPlagesHoraire();
            foreach($plageshoraire as $horaire){
            	$horaire->setDateService($horaire->getDateService());
            	$horaire->setHeureDebut($horaire->getHeureDebut());
            	$horaire->setHeureFin($horaire->getHeureFin());
            	$horaire->setService($service);
            	$manager->persist($horaire);
            }
            $service->setVendeur($user);
            $manager->persist($service);
            $manager->flush();

            return $this->redirectToRoute('um2_service_view', ['id' => $service->getId()]);
        }

        return $this->render('UM2PlatformBundle:Services:add.html.twig', [
        	'service' => $service,
            'formServices' => $form->createView(),
            'editMode' => $service->getId() !== null
        ]);
    }

    
}
