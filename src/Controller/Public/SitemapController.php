<?php

namespace App\Controller\Public;

use App\Repository\BlogPostRepository;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SitemapController extends AbstractController
{
    public function __construct(
        private readonly BlogPostRepository $blogPostRepository
    ){
    }

    #[Route('/sitemap',
        name: 'app_sitemap',
        options: [
            'sitemap' => [
            'priority' => 0.5,
            'section' => 'categories',
            'changefreq' => UrlConcrete::CHANGEFREQ_WEEKLY
            ]
        ]
    )]
    public function index(): Response
    {
        $blogPosts = $this->blogPostRepository->findBy(['status' => 'published']);

        return $this->render('public/sitemap/index.html.twig', [
            'blogPosts' => $blogPosts,
        ]);
    }
}
