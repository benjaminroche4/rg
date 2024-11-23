<?php

namespace App\EventListener;

use App\Enum\PublicationStatus;
use App\Repository\BlogCategoryRepository;
use App\Repository\BlogPostRepository;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Event listener of the sitemap bundle.
 * This class is used to populate the sitemap with the BlogCategory and BlogPost.
 */
#[AsEventListener(event: SitemapPopulateEvent::class, method: 'onSitemapPopulate')]
readonly class SiteMapEventListener
{
    public function __construct(
        public BlogCategoryRepository $blogCategoryRepository,
        public BlogPostRepository $blogPostRepository
    )
    {
    }

    public function onSitemapPopulate(SitemapPopulateEvent $event)
    {
        $categories = $this->blogCategoryRepository->findAll();
        $posts = $this->blogPostRepository->findBy(['status' => PublicationStatus::Published]);

        $urlContainer = $event->getUrlContainer();
        $urlGenerator = $event->getUrlGenerator();

        foreach ($categories as $category) {
            $url = new UrlConcrete(
                $urlGenerator->generate(
                    'app_category',
                    ['slug' => $category->getSlug()],
                    UrlGeneratorInterface::ABSOLUTE_URL)
            );
            $url->setLastmod($category->getCreatedAt());
            $url->setPriority(0.7);
            $url->setChangeFreq(UrlConcrete::CHANGEFREQ_WEEKLY);
            $urlContainer->addUrl(
                $url,
                'categories',
            );
        }

        foreach ($posts as $post) {
            $url = new UrlConcrete(
                $urlGenerator->generate(
                    'app_blog_post',
                    ['slug' => $post->getSlug()],
                    UrlGeneratorInterface::ABSOLUTE_URL)
            );
            $url->setLastmod($post->getPublishedAt());
            $url->setPriority(0.8);
            $url->setChangeFreq(UrlConcrete::CHANGEFREQ_WEEKLY);
            $urlContainer->addUrl(
                $url,
                'blog',
            );
        }
    }
}