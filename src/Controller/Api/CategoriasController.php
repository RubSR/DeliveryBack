<?php


namespace App\Controller\Api;


use App\Entity\Categoria;
use App\Form\Type\CategoriaFormType;
use App\Repository\CategoriaRepository;
use App\Repository\RestauranteRepository;
use App\Services\CategoriaService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriasController extends AbstractFOSRestController
{

    private $categoriaRepository;
    private $em;
    private $service;

    public function __construct(CategoriaRepository $categoriaRepository, EntityManagerInterface $em, CategoriaService $service)
    {
        $this->categoriaRepository = $categoriaRepository;
        $this->em = $em;
        $this->service = $service;
    }

    /**
    * @Rest\Get(path="/categorias")
    * @Rest\View(serializerGroups={"categorias"}, serializerEnableMaxDepthChecks= true)
    */

    public function getCategorias(){
        try {
            $categoria = $this->categoriaRepository->findAll();

           return $categoria;

        }catch (\Exception $e){
            return $e;
        }
    }

    /**
     * @Rest\Post(path="/categoria")
     * @Rest\View(serializerGroups={"categoria"}, serializerEnableMaxDepthChecks= true)
     */

    public function createCategoria(Request $request){
        $categoria = new Categoria();
        // Creamos un objeto form, recive dos argumentos, el formualrio que vamos a utlizar y el objeto que va a estar asociado a ese formulario
        $form = $this->createForm(CategoriaFormType::class, $categoria);
        // Le decimos que maneje la request
        $form->handleRequest($request);
        //Comprobamos  si se ha submiteado y si es valido
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($categoria);
            $this->em->flush();
            return $categoria;
        }
        return $form;

    }


    /**
     * @Rest\Post(path="/categoria/add/restaurante")
     * @Rest\View(serializerGroups={"restaurante"}, serializerEnableMaxDepthChecks= true)
     */

    public function categoriaAddRestaurante(Request $request, RestauranteRepository $restauranteRepository){
        $categorias = $request->get('categorias');
        $restauranteId = $request->get('restaurante');

        if(!$categorias || !$restauranteId){
            return new Response('La peticion debe contener informacion', Response::HTTP_BAD_REQUEST );
        }
        return $this->service->addRestaurante($categorias,$restauranteRepository,$restauranteId);

    }


    /**
     * @Rest\Post(path="/categoria/remove/restaurante")
     * @Rest\View(serializerGroups={"restaurante"}, serializerEnableMaxDepthChecks= true)
     */

    public function categoriaRemoveRestaurante(Request $request, RestauranteRepository $restauranteRepository){
        $categoria = $request->get('categoria');
        $restauranteId = $request->get('restaurante');

        if(!$categoria || !$restauranteId){
            return new Response('La peticion debe contener informacion', Response::HTTP_BAD_REQUEST );
        }
        return $this->service->removeRestaurante($categoria,$restauranteId, $restauranteRepository);

    }

}