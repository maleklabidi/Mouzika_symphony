<?php

namespace App\Form;

use App\Entity\Albums;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('artist')
            ->add('genre', ChoiceType::class, [
                'choices'  => [
                    'Pop' => 'Pop',
                    'Punk' => 'Punk',
                    'Indie' => 'Indie',
                    'Rock' => 'Rock',
                    'Electro' => 'Electro',
                ]])

            ->add('imageAlbum', FileType::class, [
                'label' => 'Image ',
                'mapped' => false,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Albums::class,
        ]);
    }
}
