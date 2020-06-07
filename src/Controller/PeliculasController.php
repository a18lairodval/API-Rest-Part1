<?php

namespace App\Controller;

use App\Repository\PeliculasRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * Class PelicuasController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class PeliculasController  extends AbstractController
{
    private $peliculaRepository;
    
    public function __construct(peliculasRepository $peliculaRepository){
        $this->peliculasRepository = $peliculaRepository;
    }

    /**
     * @Route("pelicula/{id}", name="get_one_pelicula", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $peliculas = $this->peliculasRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $peliculas->getId(),
            'nombre' => $peliculas->getNombre(),
            'genero' => $peliculas->getGenero(),
            'descripcion' => $peliculas->getDescripcion(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("peliculas", name="get_all_peliculas", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $peliculas = $this->peliculasRepository->findAll();
        $data = [];

        foreach ($peliculas as $pelicula) {
            $data[] = [
                'id' => $pelicula->getId(),
                'nombre' => $pelicula->getNombre(),
                'genero' => $pelicula->getGenero(),
                'descripcion' => $pelicula->getDescripcion(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
    
}