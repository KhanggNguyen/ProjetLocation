<?php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\CoreBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Tools\Pagination\Paginator;

use Symfony\CoreBundle\Form\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use UM2\PlatformBundle\Twig\InstanceOfExtension;


class CoreController extends Controller
{
  // La page d'accueil

	/**
	 *
	 * @Route("/", name="home")
	 *
	 */
  public function indexAction()
  { 
    // On retourne simplement la vue de la page d'accueil
    // L'affichage des 3 dernières annonces utilisera le contrôleur déjà existant dans PlatformBundle
    return $this->render('@UM2Core/Core/index.html.twig');
    // La méthode longue $this->get('templating')->renderResponse('...') est parfaitement valable
  }

  /**
   *
   *
   */
  public function searchAction(Request $request){

    $form = $this->createFormBuilder(null)
      ->setAction($this->generateUrl('um2_core_resulte'))
      ->add('recherche', TextType::class, [ 
        'attr' => [ 
          'class' => 'search-query'
          ]
        ])
      ->add('Rechercher', SubmitType::class, [
        'attr' => [
          'class' => 'btn btn-primary' 
          ]
        ])
      ->getForm();
    return $this->render('@UM2Core/Core/search.html.twig',[
      'formSearch' => $form->createView()
    ]);
  }

  public function resulteAction(Request $request){
      $formarray = $request->request->get('form');
      $recherche = $formarray['recherche'];
      $em = $this->getDoctrine()->getManager();
      $query1 = $em
        ->getRepository("UM2PlatformBundle:Outils")
        ->createQueryBuilder('o')
        ->andWhere('o.titre LIKE :recherche OR o.lieu LIKE :recherche')
        ->setParameter('recherche', '%'.$recherche.'%')
        ->getQuery()
        ->execute();  

      $query2 = $em->getRepository("UM2PlatformBundle:Services")
        ->createQueryBuilder('s')
        ->andWhere('s.titre LIKE :recherche OR s.descriptif LIKE :recherche OR s.lieu LIKE :recherche')
        ->setParameter('recherche', '%'.$recherche.'%')
        ->getQuery()
        ->execute();

      return $this->render('@UM2Core/Core/resulte.html.twig', [
        'services' => $query2,
        'outils' => $query1
      ]);
    return $this->redirectToRoute("um2_core_home");
  }

}