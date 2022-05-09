<?php

namespace App\Form;

use App\Entity\Singles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;

class SinglesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('artist')
            ->add('singleName')
            ->add('releaseDate')
            ->add('genre', ChoiceType::class, [
                'choices'  => [
                    'Pop' => 'Pop',
                    'Punk' => 'Punk',
                    'Indie' => 'Indie',
                    'Rock' => 'Rock',
                    'Electro' => 'Electro',
                ]])
            ->add('imageSingle', FileType::class, [
                'label' => 'Image ',
                'mapped' => false,
                'required' => false, ])
            ->add('audioSingle')
            ->add('albums')
            ->add('captchaCode', CaptchaType::class, array(
                'captchaConfig' => 'ExampleCaptcha'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Singles::class,
        ]);
    }
}
