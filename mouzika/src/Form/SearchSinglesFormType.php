<?php

namespace App\Form;

use App\data\searchData;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchSinglesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('q', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
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
