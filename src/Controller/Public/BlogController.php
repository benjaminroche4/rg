<?php

namespace App\Controller\Public;

use App\Enum\PublicationStatus;
use App\Repository\BlogPostRepository;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{
    public function __construct(
        private readonly BlogPostRepository $blogPostRepository,
    ){
    }

    #[Route('/blog',
        name: 'app_blog_list',
        options: [
            'sitemap' => [
                'priority' => 0.9,
                'section' => 'blog',
                'changefreq' => UrlConcrete::CHANGEFREQ_DAILY
            ]
        ]
    )]
    public function blogList(): Response
    {
        $posts = $this->blogPostRepository->findBy(['status' => PublicationStatus::Published]);

        return $this->render('public/blog/blog_list.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/blog/{slug}', name: 'app_blog_post')]
    public function blogPost(string $slug): Response
    {
        $post = $this->blogPostRepository->findOneBy(['slug' => $slug]);

        if (!$post || $post->getStatus() !== PublicationStatus::Published->value) {
            throw $this->createNotFoundException('404, Page non trouvée');
        }

        return $this->render('public/blog/blog_post.html.twig', [
            'post' => $post,
        ]);
    }
}