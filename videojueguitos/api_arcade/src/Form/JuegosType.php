<?php

namespace App\Form;

use App\Entity\Genero;
use App\Entity\Juegos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JuegosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('descripcion', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('votos_positivos', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('votos_negativos', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('imagen', FileType::class, [
                'data_class' => null,
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('generos', EntityType::class, [
                'class' => Genero::class,
                'choice_label' => 'nombre',
                'multiple' => true,
                'expanded' => true,
            ]);
    }
}    