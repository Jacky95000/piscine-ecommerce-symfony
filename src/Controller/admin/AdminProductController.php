<?php

namespace App\Controller\admin;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController {

    #[Route('/admin/create-product', name: 'admin-create-product')]
    public function displayCreateProduct(CategoryRepository $categoryRepository, Request $request) {

        if ($request->isMethod('POST')){

        $title = $request->request->get('title');
        $description = $request->request->get('description');
        $price = $request->request->get('price');
        $categoryId = $request->request->get('category-id');

        dump($title);
            dump($description);
            dump($price);
            dump($categoryId);
            

        if ($request->request->get('is-published') === 'on'){
            $isPublished = true;
        } else {
            $isPublished = false;
        }
        dump($isPublished);
}

$categories = $categoryRepository->findAll();

return $this->render('admin/create-product.html.twig', [
    'categories' => $categories
]);
}
}