<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use App\Entity\Category;
use App\Form\CategoryType;
use Laminas\Code\Reflection\FunctionReflection;
use Symfony\Component\HttpFoundation\Request;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $CategoryRepository): Response
    {
        $categories = $CategoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->save($category, true);
            $name = $category->getName();

            return $this->redirectToRoute('category_show', ['name' => $name], Response::HTTP_SEE_OTHER);
        };
        return $this->renderForm('category/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{name}', methods: ['GET'], name: 'show')]
    public function show(?Category $category, ProgramRepository $programRepository): Response
    {
        if (is_null($category)) {
            throw $this->createNotFoundException(
                "This category doesn't exist "
            );
        };

        $categoryList = $programRepository->findBy(['category' => $category], ['id' => 'DESC'], 3, 0);

        return $this->render('category/show.html.twig', [
            'categoryList' => $categoryList,
            'category' => $category,
        ]);
    }
}
