<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     *
     * @var ObjectManager
     */
    protected $manager;
    private $categoriesCount = 0;
    private $categories = array(
        'computers' => array('servers', 'desktop', 'laptops', 'components', 'peripherals'),
        'phones and tablets' => array('phones', 'tablets', 'accessories'),
        'appliances' => array('coffee machines', 'washing machines', 'blenders', 'juicers', 'fridges', 'air conditioner'),
        'video games' => array('consoles', 'games', 'accessories'),
        'televisions' => array('smart TV', 'curved TV', '3D TV', 'projectors'),
        'video' => array('video cameras', 'cam corder', 'mini cameras'),
        'books' => array('textbooks', 'magazines', 'e-books', 'audible books'),
        'sports' => array('tennis', 'football', 'fitness', 'athletic clothing', 'golf'),
        'alcoholic drinks' => array('beer', 'wine', 'strong alcohols'),
        'water' => array('sparkling', 'non sparkling'),
        'sweets' => array('chocolate', 'biscuits', 'candies'),
        'clothing' => array('for men', 'for women', 'for kids', 'casual', 'sport', 'fancy', 'for winter', 'for summer'),
        'natural products' => array('cosmetics', 'hygiene', 'medicinal plants'),
    );

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->createAndPersistData();
        $this->manager->flush();
    }

    protected function createAndPersistData()
    {
        foreach ($this->categories as $parent => $children) {
            $parentCategory = $this->createAndPersistCategory($parent);
            foreach ($children as $label) {
                $this->createAndPersistCategory($label, $parentCategory);
            }
        }
    }

    private function createAndPersistCategory($label, $parentCategory = null)
    {
        $this->categoriesCount ++;
        $category = new Category();
        $category->setLabel($label)->setParent($parentCategory);
        $this->manager->persist($category);
        $this->setReference(sprintf('category_%s', $this->categoriesCount), $category);
        
        return $category;
    }

    public function getOrder()
    {
        return 1;
    }

}
