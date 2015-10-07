<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package MainBundle\Controller
 */
class DefaultController extends Controller
{
    public function dashboardAction()
    {
        return $this->render('MainBundle:Default:dashboard.html.twig');
    }

    public function wineAction()
    {
        return $this->render('MainBundle:Default:wine.html.twig');
    }
}
