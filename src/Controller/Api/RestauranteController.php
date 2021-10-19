<?php


namespace App\Controller\Api;



use App\Form\Type\RestauranteFormType;
use App\Repository\RestauranteRepository;
use Doctrine\ORM\EntityManagerInterface;

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
                return new Response('Not found', Response::HTTP_NOT_FOUND );
            }

            return $restaurantes;
    }

    /**
     * @Rest\Get  (path="/restaurante/{id}")
     * @Rest\View ( serializerGroups={"restaurante"}, serializerEnableMaxDepthChecks= true )
     */

    public function restauranteById(Request $request){
        $id  = $request->get('id');

        $restaurante = $this->restauranteRepository->find($id);
        if(!$restaurante){
            return new Response('Not found', Response::HTTP_NOT_FOUND );
        }

        return $restaurante;
    }


    /**
     * @Rest\Post (path="/restaurante/create")
     * @Rest\View ( serializerGroups={"restaurantes_list"}, serializerEnableMaxDepthChecks= true)
     */

    public function restaurantesCreate( Request $request){

        $form = $this->buildForm(RestauranteFormType::class);
        $form->handleRequest($request);
         if(!$form->isSubmitted() || !$form->isValid()){
             return $this->respond($form, Response::HTTP_BAD_REQUEST);
         }

        $restaurante = $form->getData();

        $this->em->persist($restaurante);
        $this->em->flush();

        return $restaurante;
    }

    /**
     * @Rest\Post   (path="/restaurantes/filtered")
     * @Rest\View ( serializerGroups={"restaurante"}, serializerEnableMaxDepthChecks= true )
     */

    public function restauranteBy(Request $request){
        $dia = $request->get('dia');
        $hora = $request->get('hora');
        $idMunicipio = $request->get('municipio');



        $restaurantes = $this->restauranteRepository->findByDayAndTime($dia, $hora, $idMunicipio);

        if(!$restaurantes){
            return new Response('Not found', Response::HTTP_NOT_FOUND );
        }

        return $restaurantes;
    }



}