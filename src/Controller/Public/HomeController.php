<?php

namespace App\Controller\Public;

use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/',
        name: 'app_home',
        options: [
            'sitemap' => [
                'priority' => 1.0,
                'changefreq' => UrlConcrete::CHANGEFREQ_WEEKLY
            ]
        ]
    )]
    public function index(): Response
    {
        return $this->render('public/home/index.html.twig');
    }
}