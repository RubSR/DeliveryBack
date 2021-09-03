<?php


namespace App\Services;


use App\Entity\Restaurante;
use App\Repository\CategoriaRepository;
use App\Repository\RestauranteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class CategoriaService
{

    private $em;
    private $categoriaRepository;

    public function __construct(EntityManagerInterface $em, CategoriaRepository $categoriaRepository)
    {
        $this->em = $em;
        $this->categoriaRepository = $categoriaRepository;

    }

    public function addRestaurante( array $categorias, RestauranteRepository $restauranteRepository, $restauranteId){

        $restaurante = $restauranteRepository->find($restauranteId);
        if(!$restaurante){
            return new Response('El restaurante no existe', Response::HTTP_NOT_FOUND);}

        foreach ($categorias as $cat){
            $categoria = $this->categoriaRepository->find($cat);
            if(!$categoria){
                return new Response('La categoria, no esxite', Response::HTTP_NOT_FOUND);
            }
            $restaurante->addCategoria($this->categoriaRepository->find($cat));
        }

        $this->em->persist($restaurante);
        $this->em->flush();

        return $restaurante;

    }

    public function removeRestaurante( $catId, $resId, RestauranteRepository $restauranteRepository){
        $restaurante = $restauranteRepository->find($resId);
        $cat = $this->categoriaRepository->find($catId);
        if(!$restaurante || !$cat){
            return new Response('El restaurante o la categoria no existen', Response::HTTP_NOT_FOUND);
        }
        $restaurante->removeCategoria($cat);
        $this->em->persist($restaurante);
        $this->em->flush();

        return $restaurante;
    }

}