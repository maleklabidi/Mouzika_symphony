<?php

namespace App\Form;

use App\Entity\Albums;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('numberOfSongs')
            ->add('releaseDate')
            ->add('genre')
            ->add('artist')
            ->add('imageAlbum')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Albums::class,
        ]);
    }
}
