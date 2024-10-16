<?php

namespace App\Form;

use App\Entity\AreaContacto;
use App\Entity\Contacto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'attr' => ['maxlength' => 100],
            ])
            ->add('apellido', TextType::class, [
                'label' => 'Apellido',
                'attr' => ['maxlength' => 100],
            ])
            ->add('correo', EmailType::class, [
                'label' => 'Correo Electrónico',
                'attr' => ['maxlength' => 180],
            ])
            ->add('celular', TextType::class, [
                'label' => 'Celular',
                'attr' => ['maxlength' => 15],
            ])
            ->add('area', EntityType::class, [
                'class' => AreaContacto::class,
                'choice_label' => 'nombre',
                'label' => 'Área de Contacto',
                'placeholder' => 'Selecciona un área',
            ])
            ->add('mensaje', TextareaType::class, [
                'label' => 'Mensaje',
                'attr' => ['rows' => 5],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contacto::class,
        ]);
    }
}
