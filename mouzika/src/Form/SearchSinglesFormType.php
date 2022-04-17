<?php

namespace App\Form;

use App\data\searchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchSinglesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('q')
            ->add('p')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => searchData::class,
            'method'     => 'GET',
            'csrf_protection' => false,
            'singles'=>null
        ]);
    }

    public function fetBlockPrefix(){

        return '';
    }
}
