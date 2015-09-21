<?php

namespace AppBundle\Controller;

use AppBundle\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{

    public function listProductsAction()
    {
        $arguments = array('products' => $this->getProducts());
        return $this->render('AppBundle:product:list.html.twig', $arguments);
    }

    public function editProductAction($productId)
    {
        try {
            $product = $this->getProduct($productId);
        } catch (\Exception $exception) {
            throw $this->createNotFoundException($exception->getMessage(), $exception);
        }
        return $this->render('AppBundle:product:edit.html.twig', array('product' => $product));
    }

    public function saveProductAction($productId)
    {
        return $this->redirectToRoute('product_list');
    }

    private function getProducts()
    {
        $productService = $this->container->get(ProductService::ID);
        return $productService->getProducts();
    }

    private function getProduct($productId)
    {
        $productService = $this->container->get(ProductService::ID);
        return $productService->getProduct($productId);
    }

}
