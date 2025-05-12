<?php

namespace App\Controller\admin;

// On importe l'entité Product (produit)
use App\Entity\Product;
// On importe le repository des catégories pour interagir avec les catégories en base
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
// On importe l'EntityManager pour gérer les entités (enregistrement en BDD)
use Doctrine\ORM\EntityManagerInterface;
// Contrôleur de base de Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// Pour récupérer les données de la requête HTTP
use Symfony\Component\HttpFoundation\Request;
// Pour définir une route
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController {

    // On définit la route pour accéder au formulaire de création de produit
    #[Route('/admin/create-product', name: 'admin-create-product')]
    public function displayCreateProduct(CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $entityManager) {

        // Si le formulaire est soumis en méthode POST
        if ($request->isMethod('POST')){

            // On récupère les données envoyées depuis le formulaire
            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $price = $request->request->get('price');
            $categoryId = $request->request->get('category-id');

            // On vérifie si le produit doit être publié ou non
            if ($request->request->get('isPublished') === 'on'){
                $isPublished = true;
            } else {
                $isPublished = false;
            }

            // On récupère la catégorie associée à l’ID transmis
            $category = $categoryRepository->find($categoryId);

            try {

            

            // On crée un nouvel objet Product avec les données du formulaire
            $product = new Product($title, $description, $price, $isPublished, $category);

            // On prépare l’enregistrement du produit en base
            $entityManager->persist($product);
            // On exécute la requête d'enregistrement
            $entityManager->flush();
        } catch (\Exception $exception){
            $this->addFlash('error', $exception->getMessage());
        }
    }
        // On récupère toutes les catégories pour les afficher dans le formulaire
        $categories = $categoryRepository->findAll();

        // On rend le template Twig en lui passant la liste des catégories
        return $this->render('admin/product/create-product.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/admin/list-products', name: 'admin-list-products')]
    public function displayListProducts(ProductRepository $productRepository) {
        $products = $productRepository->findAll();

        return $this->render('admin/product/list-products.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/admin/delete-product/{id}', name: 'admin-delete-product')]
    public function deleteProduct($id, ProductRepository $productRepository, EntityManagerInterface $entityManager) {

        $product = $productRepository->find($id);

        $entityManager->remove($product);
        $entityManager->flush();

        $this->addFlash('success', 'Produit supprimé');

        return $this->redirectToRoute('admin-list-products');
    }

    #[Route('/admin/update-product/{id}', name: 'admin-update-product')]
    public function displayUpdateProduct($id, ProductRepository $productRepository, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $entityManager) {

        $product = $productRepository->find($id);

        if ($request->isMethod('POST')) {

            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $price = $request->request->get('price');
            $categoryId = $request->request->get('category-id');

            if ($request->request->get('is-published') === 'on') {
                $isPublished = true;
            } else {
                $isPublished = false;
            }
            $category = $categoryRepository->find($categoryId);
        

        try {
				$product->update($title, $description, $price, $isPublished, $category);	

				$entityManager->persist($product);
				$entityManager->flush();
			} catch (\Exception $exception) {
				$this->addFlash('error', $exception->getMessage());
			}

		}
        $categories = $categoryRepository->findAll();

        

        return $this->render('admin/product/update-product.html.twig', [
            'categories' => $categories,
            'product' => $product
        ]);
        
    }
}