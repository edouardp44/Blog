<?php


namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Article;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Category;

class DefaultController extends AbstractController
{

    /**
     * @Route("/a", name = "app_index")
     */
    public function index()
    {
        return $this->render('blog/accueil.html.twig');

    }
}