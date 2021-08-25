<?php


namespace App\Controller\Api;


use App\Entity\Categoria;
use App\Form\Type\CategoriaFormType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class CategoriasController extends AbstractFOSRestController
{

    private $categoriaRepository;
    private $em;

    public function __construct(CategoriaRepository $categoriaRepository, EntityManagerInterface $em)
    {
        $this->categoriaRepository = $categoriaRepository;
        $this->em = $em;
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

}