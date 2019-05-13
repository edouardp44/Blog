<?php


namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

    /**
     * @Route("index", name = "app_index")
     */
    public function index()
    {
        return $this->render('blog/accueil.html.twig');

    }
}