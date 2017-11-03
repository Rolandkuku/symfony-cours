<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Tag;
use AppBundle\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $tags = [];
        for ($i = 0; $i < 20; $i++) {
            $tag = new Tag();
            $tag->setName($faker->name);
            $tags[] = $tag;
            $manager->persist($tag);
        }

        for ($i = 0; $i < 20; $i++) {
            $article = new Article();
            $article->setTitle($faker->name);
            $article->setContent($faker->text);
            $articleTags = [];
            for($i2 = 0; $i2 < 5; $i2++) {
                $tag = $tags[rand(0, 19)];
                if (!in_array($tag, $articleTags)) {
                    $articleTags[] = $tag;
                    $article->addTag($tag);
                }
            }
            $manager->persist($article);
        }

        $manager->flush();
    }
}