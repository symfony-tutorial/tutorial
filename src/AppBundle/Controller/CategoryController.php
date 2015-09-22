<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\Type\CategoryType;
use AppBundle\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{

    public function listCategoriesAction()
    {
        $arguments = array('categories' => $this->getCategories());
        return $this->render('AppBundle:category:list.html.twig', $arguments);
    }

    public function listCategoriesJsonAction(Request $r)
    {
        return new JsonResponse($this->getCategories());
    }

    public function editCategoryAction(Request $request, $categoryId)
    {
        try {
            $category = $this->getCategory($categoryId);
        } catch (\Exception $exception) {
            throw $this->createNotFoundException($exception->getMessage(), $exception);
        }
        $editForm = $this->createCategoryEditForm($category);
        $deleteForm = $this->creatCategoryeDeleteForm($categoryId);

        return $this->render('AppBundle:category:edit.html.twig', array(
                    'entity' => $category,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView()
        ));
    }

    public function saveCategoryAction(Request $request, $categoryId)
    {
        try {
            $category = $this->getCategory($categoryId);
        } catch (\Exception $exception) {
            throw $this->createNotFoundException($exception->getMessage(), $exception);
        }
        $form = $this->createCategoryEditForm($category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect(
                            $this->generateUrl('category_edit', array('categoryId' => $categoryId))
            );
        }
        throw new \Exception($form->getErrors(true)->current()->getMessage());
    }

    private function createCategoryEditForm(Category $category)
    {
        return $this->createForm(new CategoryType(), $category, array(
                    'action' => $this->generateUrl(
                            'category_edit', array('categoryId' => $category->getId())
                    ),
                    'method' => 'POST',
        ));
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

    public function deleteCategoryAction(Request $request, $categoryId)
    {
        $form = $this->creatCategoryeDeleteForm($categoryId);
        $form->handleRequest($request);

        if ($form->isValid()) {
            try {
                $category = $this->getCategory($categoryId);
            } catch (\Exception $exception) {
                throw $this->createNotFoundException($exception->getMessage(), $exception);
            }

            if (!$category) {
                throw $this->createNotFoundException('Unable to find Category entity.');
            }

            $manager = $this->getDoctrine()->getManager();
            $manager->remove($category);
            $manager->flush();
        }

        return $this->redirect($this->generateUrl('category_list'));
    }

    public function deleteCategoryFormAction(Request $request, $categoryId)
    {
        $form = $this->creatCategoryeDeleteForm($categoryId);

        return $this->render($view);
    }

    private function creatCategoryeDeleteForm($categoryId)
    {
        $url = $this->generateUrl('category_delete', array('categoryId' => $categoryId));
        return $this->createFormBuilder()
                        ->setAction($url)
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm();
    }

}
