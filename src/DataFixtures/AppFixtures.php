<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $faker = Factory::Create();

        // for ($compteur = 0; $compteur < 100; $compteur++) {
        //     $advert = new Advert();
        //     $advert->setTitle($faker->sentence($nbWords = 2, $variableNbWords = true))
        //     ->setDescription($faker->paragraph($nbSentences = 3, $variableNbSentences = true))
        //     ->setCity($faker->city())
        //     ->setCarYear($faker->numberBetween($min = 2000, $max = 2020))
        //     ->setNbKm($faker->numberBetween($min = 100, $max = 10000))
        //     ->setNbDays($faker->numberBetween($min = 2, $max = 90))
        //     ->setPrice($this->price->getPrice($advert->getCarYear(),$advert->getNbKm(), $advert->getNbDays()));

        //     $manager->persist($advert);
        // }


        for ($compteur = 0; $compteur < 5 ; $compteur++) {

        $category = new Category();
        $article = new Article();


        $category->setName($faker->word())
        ->setCreated($faker->dateTime());

        $manager->persist($category);

        $article->setTitle($faker->sentence($nbWords = 2, $variableNbWords = true))
        ->setTrending($faker->boolean())
        ->setStatus($faker->numberBetween($min = 0, $max = 2))
        

        ->setContent($faker->paragraph($nbSentences = 3, $variableNbSentences = true))
        ->setCategory($category)
        ->setCreated($faker->dateTime());

        // if($article->getStatus() == 2 | 0) {
        //     $article->setPublished($faker->dateTime());
        // }

        $manager->persist($article);



        $manager->flush();
        }
    }
}