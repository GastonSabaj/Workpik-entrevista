<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

//Necesito importar la entidad y su repositorio
use App\Entity\Usuario;
use App\Repository\UsuarioRepository;

class UsuarioController extends AbstractController
{
    #[Route('/usuario', name: 'app_usuario')]
    public function index(): Response
    {
        //importo entity manager de doctrine
        $entityManager = $this->getDoctrine()->getManager();
        //obtengo los usuarios
        $usuarios = $entityManager->getRepository(Usuario::class)->findAll();
        //Ordeno a los usuarios por la cantidad de productos adquiridos en forma descendente
        usort($usuarios, function($a, $b) {
            return $b->getProductosAdquiridos() <=> $a->getProductosAdquiridos();
        });
        
        return $this->render('usuario/index.html.twig', [
            'usuarios' => $usuarios

        ]);

    }

}
