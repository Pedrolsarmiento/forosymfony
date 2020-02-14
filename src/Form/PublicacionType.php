<?php

namespace App\Form;

use App\Entity\Publicacion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('contenido')
            ->add('imagen')
            ->add('categoria')
            ->add('user',TextType::class, ['disabled' => true])
            ->add('fecha_publicacion',TextType::class, ['disabled' => true])
            ->add('guardar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Publicacion::class,
        ]);
    }
}
