<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            $article = new Article();
            $article->setTitle($faker->sentence(6, true))
                ->setContent($faker->paragraphs(3, true))
                ->setCreatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-1 years')->format('Y-m-d H:i:s')))
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setPremium($faker->boolean(20))
                ->setAuthor($faker->name());

            $manager->persist($article);
        }

        $manager->flush();
    }
}