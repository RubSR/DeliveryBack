<?php


namespace App\Form\Type;


use App\Entity\Categoria;
use App\Entity\Comentario;
use App\Entity\HorarioRestaurante;
use App\Entity\Municipios;
use App\Entity\Plato;
use App\Entity\Restaurante;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestauranteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class)
            ->add('logoUrl', TextType::class, [
                'required' => false
            ])
            ->add('imagenUrl', TextType::class, [
                'required' => false])
            ->add('descripcion', TextType::class, [
                'required' => false])
            ->add('valoracionMedia', NumberType::class, [
                'required' => false,
                'empty_data' => 0.0
            ])
            ->add('destacado', CheckboxType::class)
            ->add('categorias', EntityType::class, [
                'class' => Categoria::class,
                'multiple' => true]);

    }


    // Define a que clase hace referencia el formulario
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults( [
            'data_class' => Restaurante::class
        ]);
    }



}