<?php

namespace App\Mailer;

use App\Entity\Article;
use Twig\Environment;

class NothificationMailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $environment;

    public function __construct(\Swift_Mailer $mailer, Environment $environment)
    {
        $this->mailer = $mailer;
        $this->environment = $environment;
    }

    public function notify(Article $article)
    {
        $message = (new \Swift_Message("Un nouvel article vient d'être publié !".$article->getTitle()))
            ->setFrom($_ENV['MAILER_URL_CONTACT'])
            ->setTo( 'edouard.p44@gmail.com')
            ->setBody($this->environment->render('email/notification.html.twig',
                [
                    'article'=> $article,
                ]),'text/html');
        $this->mailer->send($message);

    }

}
