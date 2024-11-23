<?php

namespace App\Factory;

use App\Entity\BlogPost;
use App\Enum\PublicationStatus;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<BlogPost>
 */
final class BlogPostFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return BlogPost::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'title' => self::faker()->realText(60),
            'summary' => self::faker()->realText(160),
            'content' => self::faker()->realText(3000),
            'mainPhotoUrl' => self::faker()->imageUrl(800, 600),
            'publishedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'slug' => self::faker()->unique()->slug(10),
            'status' => self::faker()->randomElement(
                [
                    PublicationStatus::Published->value,
                    PublicationStatus::Archived->value,
                    PublicationStatus::Review->value,
                ]
            ),
            'category' => BlogCategoryFactory::createRange(1, 3),
            'editor' => BlogEditorFactory::createOne(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(BlogPost $blogPost): void {})
        ;
    }
}
