<?php


namespace App\Controller\Api;


use App\Repository\RestauranteRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RestauranteController extends AbstractApiController
{

    private $restauranteRepository;
    private $em;

    public function __construct(RestauranteRepository $restauranteRepository, EntityManagerInterface $em)
    {
        $this->restauranteRepository = $restauranteRepository;
        $this->em = $em;
    }

    /**
     * @Rest\Get (path="/restaurante/list")
     * @Rest\View ( serializerGroups={"restaurantes_list"}, serializerEnableMaxDepthChecks= true)
     */

    public function restaurantesList(){

            $restaurantes = $this->restauranteRepository->findAll();

            if(!$restaurantes){
                $this->respond(Response::HTTP_NOT_FOUND);
            }

            return $restaurantes;


    }




}