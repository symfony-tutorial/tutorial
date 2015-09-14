<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends Controller
{

    public function listCategoriesAction()
    {
        $arguments = array('categories' => $this->getCategories());
        return $this->render('AppBundle:category:list.html.twig', $arguments);
    }

    public function listCategoriesJsonAction()
    {
        return new JsonResponse($this->getCategories());
    }

    public function editCategoryAction($categoryId)
    {
        try {
            $category = $this->getCategory($categoryId);
        } catch (\Exception $exception) {
            throw $this->createNotFoundException($exception->getMessage(), $exception);
        }
        $arguments = array(
            'category' => $category,
            'categories' => $this->getCategories()
        );
        return $this->render('AppBundle:category:edit.html.twig', $arguments);
    }

    public function saveCategoryAction($categoryId)
    {
        return $this->redirectToRoute('category_list');
    }

    private function getCategories()
    {
        return array(
            1 => array('id' => 1, 'label' => 'Phones', 'parent' => null),
            2 => array('id' => 2, 'label' => 'Computers', 'parent' => null),
            3 => array('id' => 3, 'label' => 'Tablets', 'parent' => null),
            4 => array('id' => 4, 'label' => 'Desktop', 'parent' => array(
                    'id' => 2,
                    'label' => 'Computers')
            ),
            5 => array('id' => 5, 'label' => 'Laptop', 'parent' => array(
                    'id' => 2,
                    'label' => 'Computers')
            ),
        );
    }

    private function getCategory($categoryId)
    {
        $categories = $this->getCategories();
        if (empty($categories[$categoryId])) {
            throw new \Exception(sprintf('Invalid categoryId %s', $categoryId));
        }
        return $categories[$categoryId];
    }

}
