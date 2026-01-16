<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    

    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $parent = $this->createCategory(name: 'Informatique', parent: null, manager: $manager);
        $this->createCategory(name: 'Ordinateurs portables', parent: $parent, manager: $manager);
        $this->createCategory(name: 'Ecrans', parent: $parent, manager: $manager);
        $manager->flush();
    }

    public function createCategory(string $name, ?Category $parent, ObjectManager $manager)
    {
        $category = new Category();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $category->setParent($parent);
        $manager->persist($category);

        return $category;
    }



}
