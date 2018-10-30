<?php

namespace UM2\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServicesController extends Controller
{
    public function indexAction()
    {
        return $this->render('UM2PlatformBundle:Default:index.html.twig');
    }
}
