<?php 

namespace App\Controller\guest;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController {
    #[Route('/list-categories', name: 'list-categories')]
    public function displayListCategories(CategoryRepository $categoryRepository) {
        $categories = $categoryRepository->findAll();

        return $this->render('guest/category/list-categories.html.twig', ['categories' => $categories,
    ]);
    }

    #[Route('/details-category/{id}', name: 'details-category')]
    public function detailCategory($id, CategoryRepository $categoryRepository) {
        $category = $categoryRepository->find($id);
        
        return $this->render('guest/category/details-category.html.twig', [
            'category' => $category
        ]);
    }
}