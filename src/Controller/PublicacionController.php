<?php

namespace App\Controller;

use App\Entity\Publicacion;
use App\Entity\User;
use App\Form\PublicacionType;
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


    /**
     * @Route("/publicacion/detalle/{id<\d+>}", name="publicacion-detalle")
     */
    public function detalle($id, Publicacion $publicacion)
    {
//          Esto se puede simplificar
//        $pr = $this->getDoctrine()->getRepository(Publicacion::class);
//        $publicacion = $pr->find($id);
//
//        if($publicacion == null) {
//            throw $this->createNotFoundException('Publicacion no existe');
//        }


        return $this->render('publicacion/detalle.html.twig', [
            'publicacion' => $publicacion,
            'comentarios' => $publicacion->getComentarios()
        ]);
    }

    /**
     * @Route("/publicacion/nueva", name="publicacion-nueva")
     */
    public function nueva()
    {

        $p = new Publicacion();

        $form = $this->createForm(PublicacionType::class, $p);
        $form->get('user')->setData($this->getUser()->getUsername());
        $d = new \DateTime('now');
        $form->get('fecha_publicacion')->setData($d->format("Y-m-d H:i:s"));

        return $this->render('publicacion/nueva.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
