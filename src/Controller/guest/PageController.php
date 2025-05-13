<?php

namespace App\Controller\guest;

// Contrôleur de base Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// Pour gérer les réponses HTTP
use Symfony\Component\HttpFoundation\Response;
// Pour déclarer les routes
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController {

    // Route pour la page d'accueil du site ("/")
    #[Route('/', name: 'home', methods: ['GET'])]
    public function displayHome (): Response {
        // On rend le template de la page d'accueil
        return $this->render('guest/home.html.twig');
    }
    #[Route('/404', name: '404', methods: ['GET'])]
	public function display404(): Response
	{
		return $this->render('guest/404.html.twig');
	}
}