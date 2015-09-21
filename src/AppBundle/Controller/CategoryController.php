<?php

namespace AppBundle\Controller;

use AppBundle\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends Controller
{

    public function listCategoriesAction()
    {
        $arguments = array('categories' => $this->getCategories());
        return $this->render('AppBundle:category:list.html.twig', $arguments);
    }

    public function listCategoriesJsonAction(\Symfony\Component\HttpFoundation\Request $r)
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
        $categoryService = $this->container->get(CategoryService::ID);
        return $categoryService->getCategories();
    }

    private function getCategory($categoryId)
    {
        $categoryService = $this->container->get(CategoryService::ID);
        return $categoryService->getCategory($categoryId);
    }

}
