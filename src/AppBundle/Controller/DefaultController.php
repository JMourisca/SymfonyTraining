<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}", name="homepage")
     */
    public function indexAction($name = 'from the other side')
    {
        //$name = $request->query->get('name', 'from the other side'); /hello?name=bla
        //$name = $request->attributes->get('name', 'from the other side'); // /hello/name

        return $this->render('default/index.html.twig', ['name' => $name]);
    }
}
