<?php

namespace AppBundle\Service;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService
{

    const ID = 'app.category';

    /**
     *
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->entityManager = $manager;
    }

    public function getCategories($includeDeleted = false)
    {
        $criteria = array();
        if (!$includeDeleted) {
            $criteria = array('deleted' => false);
        }

        return $this->entityManager->getRepository(Category::REPOSITORY)->findBy($criteria);
    }

    public function getCategory($categoryId)
    {
        $category = $this->entityManager
                        ->getRepository(Category::REPOSITORY)->find($categoryId);
        if (empty($category)) {
            throw new \Exception(sprintf('Invalid categoryId %s', $categoryId));
        }
        return $category;
    }

}
