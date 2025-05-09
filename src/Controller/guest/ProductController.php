<?php

namespace App\Controller\guest;

// On importe le repository pour interagir avec les produits
use App\Repository\ProductRepository;
// Contrôleur de base de Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// Pour définir les routes
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController {

    // Route pour afficher la liste des produits publiés
    #[Route('/list-products', name:'list-products')]
	public function displayListProducts(ProductRepository $productRepository) {
		// On récupère uniquement les produits publiés depuis la base de données
		$productsPublished = $productRepository->findBy(['isPublished' => true]);

		// On affiche la vue avec la liste des produits
		return $this->render('guest/product/list-products.html.twig', [
			'products' => $productsPublished
		]);
	}

    // Route pour afficher les détails d’un produit (⚠️ il manque un paramètre dans la route !)
    #[Route('/details-product', name: 'details-product')]
    public function displayProduct(ProductRepository $productRepository, $id) {
        // On récupère le produit correspondant à l’ID
        $products = $productRepository->find($id);

        // On affiche la vue des détails du produit
        return $this->render('guest/product/details-product.html.twig', [
            'products' => $products,
        ]);
    }
}