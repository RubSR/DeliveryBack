<?php


namespace App\Form\Type;



use App\Entity\HorarioRestaurante;
use App\Entity\Restaurante;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class HorRestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dia', IntegerType::class, [
            'required' => false])
            ->add('apertura', TimeType::class, [
                'required' => false,
                'widget'=> 'single_text'
            ])
            ->add('cierre', DateTimeType::class, array('widget' => 'single_text','format' => 'HH:mm:ss', 'html5'=>false))
            ->add('restaurante', EntityType::class,[
                'class' => Restaurante::class,
                'constraints'=> [
                    new NotNull()
                ]
            ]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults( [
            'data_class' => HorarioRestaurante::class
        ]);
    }



}