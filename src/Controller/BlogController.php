<?php


namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    /**
    * @Route("/blog", name="blog_index")
    */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Edouard',
        ]);

    }
}