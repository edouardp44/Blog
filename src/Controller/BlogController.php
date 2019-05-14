<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
    * @Route("/index", name="index")
    */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Edouard',
        ]);

    }

    /**
     * @Route("/show/{slug}", requirements={"slug"="[a-z0-9\-]*"})
     */
    public function show(string $slug ="article sans titre"): Response
    {
        return $this->render('blog/blog.html.twig',
            [
                'title' => ucwords(str_replace('-',' ', $slug)),
            ]);

    }
}