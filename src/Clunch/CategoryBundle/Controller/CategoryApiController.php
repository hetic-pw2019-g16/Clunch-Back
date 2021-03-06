<?php
/**
 * Created by PhpStorm.
 * User: Samy Yahia
 * Date: 2019-03-24
 * Time: 17:33
 */

namespace Clunch\CategoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Clunch\CategoryBundle\Entity\Category;
use Clunch\RecipeBundle\Entity\Recipe;

/**
 * Class CategoryApiController
 * @package Clunch\CategoryBundle\Controller
 */
class CategoryApiController extends Controller
{
    /**
     * Function to get Category List From Category Entity
     * Route: /api/categories
     * Method: GET
     *
     * @return Response
     */
    public function getCategoriesAction()
    {
        $serializer = $this->get('jms_serializer');

        $em = $this->getDoctrine()->getManager();
        $categoryRepository = $em->getRepository(Category::class);
        $categoryList = $categoryRepository->findAll();
        $categoryList = $serializer->serialize($categoryList, 'json');

        return new Response($categoryList);
    }

    /**
     * Function to get Category Item by id
     * Route: /api/category/{id}/recipes
     * Method: GET
     *
     * @param $id
     * @return Response
     */
    public function getCategoryRecipesAction($id)
    {
        $serializer = $this->get('jms_serializer');

        $em = $this->getDoctrine()->getManager();
        $categoryRepository = $em->getRepository(Category::class);
        $categoryItem = $categoryRepository->find($id);

        $recipeRepository = $em->getRepository(Recipe::class);
        $recipeList = $recipeRepository->findByCategory($categoryItem);

        $recipeList = $serializer->serialize($recipeList, 'json');

        return new Response($recipeList);
    }


    /**
     * Function to get Recipe Item by id
     * Route: /api/categories/search
     * Method: GET
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getCategoriesSearchAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');

        $em = $this->getDoctrine()->getManager();

        $query = $request->get('query');

        $categoryRepository = $em->getRepository(Category::class);
        $categoryList = $categoryRepository->search($query);

        $categoryList = $serializer->toArray($categoryList);

        return new JsonResponse($categoryList);
    }
}
