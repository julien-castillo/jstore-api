<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController {

private $manager;

    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    /**
     * @Route("/register", name="security_register")
     */
    public function register(Request $request): Response {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

// Analyse de la requête par le formualire

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Traitement des données reçues du formulaire
            $this->manager->persist($user);
            $this->manager->flush();
            return $this->redirectToRoute("home");
        }

        return $this->render('security/index.html.twig', [
            'controller_name' => 'Inscription',
            'form' => $form->createView()
        ]);
    }
}
