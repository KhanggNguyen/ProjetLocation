<?php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\PlatformBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Session\Session;

use UM2\PlatformBundle\Entity\Outils;
use UM2\PlatformBundle\Entity\OutilsUser;
use UM2\PlatformBundle\Entity\OutilsTaxonomie;
use UM2\PlatformBundle\Entity\Taxonomie;

use UM2\PlatformBundle\Form\OutilsType;
use UM2\PlatformBundle\Form\OutilsEditType;

use UM2\PlatformBundle\Repository\OutilsRepository;
use UM2\PlatformBundle\Repository\OutilsTaxonomieRepository;
use Symfony\Component\Validator\Constraints\DateTime;



class OutilsController extends Controller
{

    public function viewAction(Outils $outil = null)
    {   
        if(!$outil){
            return $this->redirectToRoute("um2_core_home");
        }

        $listDateNonDispo = $this->getDoctrine()
            ->getManager()
            ->getRepository('UM2PlatformBundle:OutilsUser')
            ->findByOutil($outil->getid());

        return $this->render('UM2PlatformBundle:Outils:view.html.twig', array(
        	'outil' => $outil,
            'listDateNonDispo' => $listDateNonDispo,
        ));
    }

    public function showListToolsAction($page, $nbPerPage = null){
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

        $listOutils = $this->getDoctrine()
            ->getManager()
            ->getRepository('UM2PlatformBundle:Outils')
            ->getOutilsByUser($user->getId(),$page,$nbPerPage);

        $nbPages = ceil(count($listOutils) / $nbPerPage);

        return $this->render('UM2PlatformBundle:Outils:mytools.html.twig', array(
            'listOutils' => $listOutils,
            'nbPages'     => $nbPages,
            'page'        => $page,
        ));
    }

    public function rentAction(Outils $outil  = null, Request $request){
        $auth_checker = $this->get('security.authorization_checker');
        if(!$auth_checker->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
            return $this->redirectToRoute("um2_user_login");
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($outil->getVendeur()->getId() == $user->getId())
        {
            return $this->redirectToRoute('um2_outil_view', ['id' => $outil->getId()]);
        }
        try {
            $dateLoue = $request->request->get('dateLoue');
            $outilUser = new OutilsUser();
            $outilUser->setDate(new \DateTime($dateLoue));
            $outilUser->setOutil($outil);
            $outilUser->setUser($user);
            $user->setCagnote();//incrémenter cagnote par 1
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($outilUser);
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('flash_key',"Vous avez ajouté avec succès");
        }catch(\Doctrine\DBAL\DBALException $e){
            $this->addFlash('flash_key',"La date que vous choisi a été pris ! Veuillez selectionner une autre date.");
        }
        return $this->redirectToRoute('um2_outil_view', ['id' => $outil->getId()]);
    }

    public function addAction(Outils $outil = null, Request $request)
    {   
        $auth_checker = $this->get('security.authorization_checker');
        if(!$auth_checker->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirectToRoute("um2_user_login");
        }

        if(!$outil)
        {
            $outil = new Outils();
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $routeName = $request->get('_route');
        if($routeName == 'um2_outil_edit'){
            if(!$outil->getVendeur()->getId() == $user->getId()){
                return $this->redirectToRoute('um2_outil_view', ['id' => $outil->getId()]);
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
            $form = $this->createForm(OutilsEditType::class, $outil);
        }else{
            $form = $this->createForm(OutilsType::class, $outil);
        }

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!$outil->getId()){
                $outil->setDate();
            }
            $manager=$this->getDoctrine()->getManager();

            $listMotsCles = $request->get('motscles');
            $array_listMotsCles = explode(" ", $listMotsCles);
            foreach($array_listMotsCles as $mot){
                $mot_temp = new Taxonomie();
                $mot_temp->setMotCle($mot);
                $mot_temp->setType('Outil');
                $manager->persist($mot_temp);

                $motOutil = new OutilsTaxonomie();
                $motOutil->setOutil($outil);
                $motOutil->setMotcle($mot_temp);
                $manager->persist($motOutil);
            }

            $outil->setVendeur($user);
            
            $manager->persist($outil);
            $manager->flush();

            return $this->redirectToRoute('um2_outil_view', ['id' => $outil->getId()]);
        }

        return $this->render('UM2PlatformBundle:Outils:add.html.twig', [
            'formOutils' => $form->createView(),
            'editMode' => $outil->getId()!== null,
            'motscle' => $motsCles
        ]);
    }

    public function activateAction(Outils $outil = null)
    {   
        $auth_checker = $this->get('security.authorization_checker');
        if(!$auth_checker->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirectToRoute("um2_user_login");
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if(!$outil){
            return $this->redirectToRoute("um2_user_index");
        }
        
        if($outil->getVendeur()->getId() != $user->getId()){
            return $this->redirectToRoute('um2_outil_view', ['id' => $outil->getId()]);
        }

        if($outil->getActive()){
            $outil->setActive(false);
        }else{
            $outil->setActive(true);
        }
        
        $manager=$this->getDoctrine()->getManager();
        $manager->persist($outil);
        $manager->flush();

        return $this->redirectToRoute("um2_outils_user");

    }
    public function indexAction($page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $nbPerPage = $this->container->getParameter('nbPerPage');

        $listOutils = $this->getDoctrine()
            ->getManager()
            ->getRepository('UM2PlatformBundle:Outils')
            ->getOutils($page,$nbPerPage);

        $nbPages = ceil(count($listOutils) / $nbPerPage);

        return $this->render('UM2PlatformBundle:Outils:index.html.twig', array(
            'listOutils' => $listOutils,
            'nbPages'     => $nbPages,
            'page'        => $page,
        ));
    }
}
