<?php

namespace AppBundle\Service;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{

    const ID = 'app.product';

    /**
     *
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->entityManager = $manager;
    }

    public function getProducts()
    {
        return $this->entityManager->getRepository(Product::REPOSITORY)->findAll();
    }

    public function getProduct($productId)
    {
        $product = $this->entityManager->getRepository(Product::REPOSITORY)->find($productId);
        if (empty($product)) {
            throw new \Exception(sprintf('Invalid product %s', $productId));
        }
        return $product;
    }

}
