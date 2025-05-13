<?php

namespace App\Controller\guest;

// On importe le repository pour interagir avec les produits
use App\Repository\ProductRepository;
// Contrôleur de base de Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
// Pour définir les routes
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController {

    // Route pour afficher la liste des produits publiés
    #[Route('/list-products', name:'list-products', methods: ['GET'])]
	public function displayListProducts(ProductRepository $productRepository): Response {
		// On récupère uniquement les produits publiés depuis la base de données
		$productsPublished = $productRepository->findBy(['isPublished' => true]);

		// On affiche la vue avec la liste des produits
		return $this->render('guest/product/list-products.html.twig', [
			'products' => $productsPublished
		]);
	}

    // Route pour afficher les détails d’un produit (⚠️ il manque un paramètre dans la route !)
    #[Route('/details-product', name: 'details-product', methods: ['GET'])]
    public function displayProduct(ProductRepository $productRepository, $id): Response {
        // On récupère le produit correspondant à l’ID
        $product = $productRepository->find($id);

        if(!$product) {
			return $this->redirectToRoute("404");
		}
        // On affiche la vue des détails du produit
        return $this->render('guest/product/details-product.html.twig', [
            'products' => $product,
        ]);
    }
}