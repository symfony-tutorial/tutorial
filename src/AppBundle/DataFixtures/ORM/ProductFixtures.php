<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    private $productsCount = 0;
    private $productsPerCategory = 500;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->createAndPersistData();
        $this->manager->flush();
    }

    private function createAndPersistProducts(Category $category)
    {
        for ($i = 1; $i <= $this->productsPerCategory; $i++) {
            $this->productsCount++;
            $product = new Product();
            $product->setCode(sprintf('code-%s-%s', $category->getId(), $i))
                    ->setTitle(sprintf('title %s %s %s', $category->getId(), $i, uniqid()))
                    ->setDescription(sprintf('product description %s', $i))
                    ->setCategories(new ArrayCollection(array($category)));
            $this->manager->persist($product);
            $this->setReference(sprintf('product_%s', $this->productsCount), $product);
        }
    }

    protected function createAndPersistData()
    {
        foreach ($this->getReferences('category') as $category) {
            $this->createAndPersistProducts($category);
            $this->manager->flush();
        }
    }

    protected function getReferences($prefix)
    {
        $entities = array();
        for ($i = 1; true; $i++) {
            try {
                $entities[] = $this->getReference(sprintf('%s_%s', $prefix, $i));
            } catch (\OutOfBoundsException $exception) {
                break;
            }
        }

        return $entities;
    }

    public function getOrder()
    {
        return 2;
    }

}
