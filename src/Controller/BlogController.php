<?php


namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleSearchType;
use App\Form\ArticleType;
use Doctrine\Common\Collections\ArrayCollection;
use PhpParser\Builder\Interface_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    /**
    * @Route("/", name="blog_index")
    */
    public function index(SessionInterface $session ) : Response
    {
        if (!$session->has('total')) {
            $session->set('total', 0);
        }

        $total = $session->get('total');

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles){
            throw $this->createNotFoundException(
                "No articles found in article's table."
            );
        }

        return $this->render('blog/index.html.twig', [
            'owner' => 'Edouard',
            'articles' => $articles,
        ]);

    }

    /**
    @param string $slug The slugger
     *
     * @Route("/blog/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     *  @return Response A response instance
     */
    public function show(string $slug ="article sans titre"): Response
    {
        if (!$slug)
        {
            throw $this->createNotFoundException('No slug has been sent to find an article in article\'s table .');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title'=> mb_strtolower($slug)]);

        if (!$article)
        {
            throw $this->createNotFoundException(
                'No article with '.$slug.' title found in article\'s table.'
            );
        }


        return $this->render('blog/blog.html.twig',
            [
                'title' => ucwords(str_replace('-',' ', $slug)),
                'article' => $article,
                'slug' => $slug,

            ]);

    }

    /**
     * @Route("/cat/{name}", name="blog_category").
     */
    public function showByCategory(Category $category): Response
    {

        return $this->render('blog/category.html.twig',
            [
                'articles' => $category->getArticles(),
            ]);

    }

}