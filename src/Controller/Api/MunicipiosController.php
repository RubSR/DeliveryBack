<?php


namespace App\Controller\Api;


use App\Repository\MunicipiosRepository;
use App\Repository\RestauranteRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class MunicipiosController extends AbstractApiController
{
    private $restauranteRepository;
    private $municipioRespository;
    private $em;

    public function __construct(RestauranteRepository $restauranteRepository, MunicipiosRepository $municipioRespository, EntityManagerInterface $em)
    {
        $this->restauranteRepository = $restauranteRepository;
        $this->municipioRespository = $municipioRespository;
        $this->em = $em;
    }

    /**
     * @Rest\Post (path="/restaurante/add/municipio/")
     * @Rest\View (serializerGroups={"restaurantes_list"}, serializerEnableMaxDepthChecks=true)
     */

    public function restauranteAddMunicipio(Request $request){
        $restauranteId = $request->get('restaurante');
        $municipioId = $request->get('municipio');
        $restaurante = $this->restauranteRepository->find($restauranteId);
        $restaurante->addMunicipiosReparto($this->municipioRespository->find($municipioId));
        $this->em->persist($restaurante);
        $this->em->flush();
        return $restaurante;

    }


}