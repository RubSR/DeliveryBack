<?php


namespace App\Form\Type;


use App\Entity\Categoria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriaFormType extends AbstractType
{

    // Siempre implemente a un funcion buildForm donde indicamos los parametros de la clase y el tipo asi como otras opciones

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('categoria', TextType::class);
    }


    // Define a que clase hace referencia el formulario
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults( [
            'data_class' => Categoria::class
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

    public function  getName(){
        return '';
    }

}