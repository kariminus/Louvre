<?php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends controller
{
    public function choiceAction()
    {
        $content = $this->get('templating')->render('OCPlatformBundle:Order:choice.html.twig');

        return new Response($content);
    }
}