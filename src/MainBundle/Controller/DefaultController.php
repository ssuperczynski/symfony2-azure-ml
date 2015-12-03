<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package MainBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mushroomAction()
    {
        return $this->render('MainBundle:Default:mushroom.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function shopAction()
    {
        return $this->render('MainBundle:Default:shop.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function wineAction()
    {
        return $this->render('MainBundle:Default:wine.html.twig');
    }
}
