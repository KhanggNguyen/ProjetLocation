<?php

namespace UM2\PlatformBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;

use UM2\PlatformBundle\Entity\Outils;
use UM2\PlatformBundle\Form\OutilsType;
use UM2\PlatformBundle\Repository\OutilsRepository;


class OutilsController extends Controller
{

    public function viewAction(Outils $outil)
    {
        return $this->render('UM2PlatformBundle:Outils:view.html.twig', array(
        	'outil' => $outil
        ));
    }

    public function addAction(Outils $outil = null, Request $request)
    {
        if(!$outil)
        {
            $outil = new Outils();
        }

        $form = $this->createForm(OutilsType::class, $outil);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if(!$outil->getId()){
                $outil->setDate();
            }
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($outil);
            $manager->persist();

            return $this->redirectToRoute('outils_view', ['id' => $outil->getId()]);
        }

        return $this->render('UM2PlatformBundle:Outils:add.html.twig', [
            'formOutils' => $form->createView(),
            'editMode' => $outil->getId()!== null
        ]);
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
        if ($page > $nbPages) 
        {
        throw $this->createNotFoundException("La page ".$page." n'existe pas.");
      }

        return $this->render('UM2PlatformBundle:Outils:index.html.twig', array(
            'listOutils' => $listOutils,
            'nbPages'     => $nbPages,
            'page'        => $page,
        ));
    }
}
