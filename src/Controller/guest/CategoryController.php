<?php 

namespace App\Controller\guest;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController {
    #[Route('/list-categories', name: 'categories')]
    public function displayCategory(CategoryRepository $categoryRepository) {
        $categories = $categoryRepository->findAll();

        return $this->render('guest/list-categories.html.twig', ['categories' => $categories,
    ]);
    }

    #[Route('/category/{id}', name: 'category_show')]
    public function showCategory($id, CategoryRepository $categoryRepository) {
        $category = $categoryRepository->find($id);
        
        return $this->render('guest/show-categories.html.twig', [
            'category' => $category
        ]);
    }
}