<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package MainBundle\Controller
 */
class DefaultController extends Controller
{
    public function mushroomAction()
    {
        return $this->render('MainBundle:Default:mushroom.html.twig');
    }

    public function shopAction()
    {
        return $this->render('MainBundle:Default:shop.html.twig');
    }
}
