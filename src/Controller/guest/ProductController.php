<?php

namespace App\Controller\guest;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController {

    #[Route('/list-products', name:'list-products')]
	public function displayListProducts(ProductRepository $productRepository) {
		
		$productsPublished = $productRepository->findBy(['isPublished' => true]);

		return $this->render('guest/product/list-products.html.twig', [
			'products' => $productsPublished
		]);
	}

    #[Route('/details-product', name: 'details-product')]
    public function displayProduct(ProductRepository $productRepository, $id) {
        $products = $productRepository->find($id);

        return $this->render('guest/product/details-product.html.twig', [
            'products' => $products,
        ]);
    }

    
}