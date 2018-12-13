<?php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\CoreBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

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

}