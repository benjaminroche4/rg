<?php

namespace App\DataFixtures;

use App\Factory\BlogCategoryFactory;
use App\Factory\BlogEditorFactory;
use App\Factory\BlogPostFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * php bin/console doctrine:fixtures:load
 */
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        BlogPostFactory::createMany(20);
        UserFactory::createMany(10);
    }
}
