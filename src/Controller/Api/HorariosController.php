<?php


namespace App\Controller\Api;


use App\Form\Type\HorRestFormType;
use App\Repository\HorarioRestauranteRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class HorariosController extends AbstractApiController
{

    private $horariosRepository;
    private $em;

    public function __construct(HorarioRestauranteRepository $horariosRepository, EntityManagerInterface $em)
    {
        $this->horariosRepository = $horariosRepository;
        $this->em = $em;
    }

    // Crear Horario

    /**
     * @Rest\Post (path="/horario/create")
     * @Rest\View (serializerGroups={"horario"}, serializerEnableMaxDepthChecks=true )
     */

    public function horarioCreate( Request $request){

      $form = $this->buildForm(HorRestFormType::class);
      $form->handleRequest($request);
        if(!$form->isSubmitted() || !$form->isValid()){
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        $horario = $form->getData();

        $this->em->persist($horario);
        $this->em->flush();

        return $horario;


    }

}