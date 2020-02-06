<?php

namespace App\Controller;

use App\Entity\Publicacion;
use App\Repository\PublicacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicacionController extends AbstractController
{
    /**
     * @Route("/ultimas", name="ultimas_publicaciones")
     */
    public function index(PublicacionRepository $repository)
    {
        //preguntar a los modelos

        //$repository = $this->getDoctrine()->getRepository(Publicacion::class);
        $publicaciones = $repository->findAll();

        //pintar en vista
        return $this->render('publicacion/index.html.twig', [
            'listado_publicaciones' => $publicaciones
        ]);
    }
}
