<?php


namespace App\Form\Type;



use App\Entity\Municipios;

use App\Entity\Provincias;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorarioFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('municipio', TextType::class, [
            'required' => false])
            ->add('idProvincia', Provincias::class, [
                'required' => false
            ]);






    }


    // Define a que clase hace referencia el formulario
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults( [
            'data_class' => HorarioRestaurante::class
        ]);
    }



}
