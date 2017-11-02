<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/{name}", name="homepage")
     * @Method({"GET"})
     */
    public function indexAction($name)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            "name" => $name
        ]);
    }
}