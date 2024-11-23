<?php

namespace App\Controller\Public;

use App\Repository\BlogCategoryRepository;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    public function __construct(
        private readonly BlogCategoryRepository $blogCategoryRepository,
    ){
    }

    #[Route('/categories',
        name: 'app_category_list',
        options: [
            'sitemap' => [
                'priority' => 0.9,
                'section' => 'categories',
                'changefreq' => UrlConcrete::CHANGEFREQ_WEEKLY
            ]
        ]
    )]
    public function categoryList(): Response
    {
        $categories = $this->blogCategoryRepository->findAll();

        return $this->render('public/category/category_list.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route(
        path: [
            'fr' => '/categorie/{slug}',
            'en' => '/category/{slug}'
        ],
        name: 'app_category'
    )]
    public function category(string $slug): Response
    {
        $category = $this->blogCategoryRepository->findOneBy(['slug' => $slug]);

        if (!$category) {
            throw $this->createNotFoundException('Category not found');
        }

        $blogPostsAssociated = $category->getBlogPosts();

        return $this->render('public/category/category.html.twig', [
            'name' => $category->getName(),
            'blogPosts' => $blogPostsAssociated,
        ]);
    }
}
