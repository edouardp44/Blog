<?php

namespace App\Controller;

use Doctrine\Common\Annotations\Annotation\Required;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Required ROLE_ADMIN for *every* controller method in this class
 *
 * @IsGranted("ROLE_ADMIN")
 * @Route("/admin")
 */

class AdminController extends AbstractController
{
    /**
     * Require ROLE_ADMIN for only this controller method.
     *
     * @IsGranted("ROLE_ADMIN")
     *
     *@Route("/", name="admin_index", methods={"GET"})
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();
        return new Response('Well hi there '.$user->getFirstName());

        /*return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);*/
    }

    public function adminDashboard()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
    }
}
