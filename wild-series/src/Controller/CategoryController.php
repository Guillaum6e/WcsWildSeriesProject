<?php
// src/Controller/CategoryController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use App\Entity\Category;

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
