<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ProductFixtures extends Fixture
{
    

    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR');

        for($prod = 1; $prod<=10; $prod++) {
            
            $product = new Product();
            $product->setName($faker->text(15));
            $product->setDescription($faker->text(100));
            $product->setSlug($this->slugger->slug($product->getName())->lower());
            $product->setPrice($faker->randomFloat(2, 10, 100));
            $product->setStock($faker->numberBetween(1, 100));
            $manager->persist($product);

        }

        $manager->flush();
    }



}
