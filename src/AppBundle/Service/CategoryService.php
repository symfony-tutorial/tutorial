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

    public function getCategories()
    {
        return $this->entityManager->getRepository(Category::REPOSITORY)->findAll();
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
