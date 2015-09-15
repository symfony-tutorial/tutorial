<?php

namespace AppBundle\Controller;

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
        return array(
            1 => array('id' => 1, 'title' => 'Padfone2', 'code' => 'padfone2', 'description' => 'an awesome padfone'),
            2 => array('id' => 2, 'title' => 'Gforce 750x df-15', 'code' => 'gforce750xdf15', 'description' => 'an awesome graphic card'),
            3 => array('id' => 3, 'title' => 'Acer aspire 25147', 'code' => 'aceraspire25147', 'description' => 'an awesome laptop'),
            4 => array('id' => 4, 'title' => 'Allview T-152 2Gb', 'code' => 'allviewt1522gb', 'description' => 'an awesome tablet'),
        );
    }

    private function getProduct($productId)
    {
        $products = $this->getProducts();
        if (empty($products[$productId])) {
            throw new \Exception(sprintf('Invalid productId %s', $productId));
        }
        return $products[$productId];
    }

}
