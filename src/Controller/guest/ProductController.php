<?php

namespace App\Controller\guest;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController {
    #[Route('/products', name: 'guest_products')]
    public function displayProduct(ProductRepository $productRepository) {
        $products = $productRepository->findAll();

        return $this->render('guest/index-product.html.twig', [
            'products' => $products,
        ]);
    }

    
}