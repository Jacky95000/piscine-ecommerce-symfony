<?php 

namespace App\Controller\guest;

// On importe le repository pour interagir avec les catégories
use App\Repository\CategoryRepository;
// Contrôleur de base Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
// Pour déclarer les routes
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController {

    // Route pour afficher la liste des catégories
    #[Route('/list-categories', name: 'list-categories', methods: ['GET'])]
    public function displayListCategories(CategoryRepository $categoryRepository): Response {
        // On récupère toutes les catégories depuis la base de données
        $categories = $categoryRepository->findAll();

        // On affiche le template avec la liste des catégories
        return $this->render('guest/category/list-categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    // Route pour afficher les détails d'une catégorie précise (grâce à son ID)
    #[Route('/details-category/{id}', name: 'details-category', methods: ['GET'])]
    public function detailCategory($id, CategoryRepository $categoryRepository): Response {
        // On récupère une seule catégorie grâce à son ID
        $category = $categoryRepository->find($id);
        

        if(!$category) {
            return $this->redirectToRoute("404");
        }
        // On affiche le template avec les détails de la catégorie
        return $this->render('guest/category/details-category.html.twig', [
            'category' => $category
        ]);
    }
}