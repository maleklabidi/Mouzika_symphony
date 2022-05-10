<?php

namespace App\Form;

use App\Entity\Titres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use blackknight467\StarRatingBundle\Form\RatingType;

class TitresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('artiste')
            ->add('rating', RatingType::class, [
                 'label' => 'Rating'
             ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Titres::class,
        ]);
    }
}
