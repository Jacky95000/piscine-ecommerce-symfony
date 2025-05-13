<?php

namespace App\Controller\guest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends AbstractController {

    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function displayLogin(AuthenticationUtils $authentificationUtils): Response {

        $error = $authentificationUtils->getLastAuthenticationError();

        return $this->render('guest/login.html.twig', [
            'error' => $error
        ]);
    }

    #[Route('/logout', name: "logout", methods: ['GET'])]
	public function logout() {

}
}