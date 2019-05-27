<?php


namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ArticlesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++)
        {
            $article = new Article();
            $article->setTitle(mb_strtolower($faker->sentence()));
            $article->setContent($faker->text($maxNbChars = 200));
            $manager->persist($article);
            $article->setCategory($this->getReference('categorie_0'));
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}