<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductPicture;
use App\Entity\Category;
use App\Entity\Tva;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        
        $name = 'Classic';
        $rate = 20;
        $valid = true;
        
        $tva = new Tva;
        $tva->setName($name)
            ->setRate($rate)
            ->setValid($valid);
        $manager->persist($tva);
         
        for($c=1;$c < 5;$c++)
        {
            $cat = new Category();
            $cat->setTitle($faker->realText(20))
                ->setDescription($faker->realText(200))
                ->setPicture('https://picsum.photos/id/' . $faker->numberBetween(1, 1050) . '/1920/1080')
                ->setValid($faker->boolean($chanceOfGettingTrue = 100))
                ->setCreatedAt(new \DateTime())
                ->setPermalink($faker->slug(3));
            $manager->persist($cat);

            for($p=1;$p<10;$p++)
            {
                $product = new Product();
                
                $picture = new ProductPicture();
                $picture->setTitle($faker->realText(20))
                        ->setDescription($faker->realText(200))
                        ->setFile('https://picsum.photos/id/' . $faker->numberBetween(1, 1050) . '/1920/1080')
                        ->setCreatedAt(new \DateTime())
                        ->setValid($faker->boolean($chanceOfGettingTrue = 100));
                $manager->persist($picture);
                
                $product->setName($faker->realText(20))
                        ->setDescription($faker->realText(200))
                        ->setPrice($faker->randomFloat(2,0,10000))
                        ->setQuantity($faker->numberBetween(0,200))
                        ->setReference($faker->unique()->ean13)
                        ->setCreatedAt(new \DateTime())
                        ->setCategory($cat)
                        ->setValid($faker->boolean($chanceOfGettingTrue = 100))
                        ->setPermalink($faker->slug(3))
                        ->setWeight($faker->randomFloat(2,0,300))
                        ->addProductPicture($picture)
                        ->setTva($tva);

                $manager->persist($product);
            }
        }
        $manager->flush();
    }
}
