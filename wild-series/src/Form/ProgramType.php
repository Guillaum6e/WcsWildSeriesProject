<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre',
                    'class' => 'formInput',
                ],
                'label' => 'Titre du programme',
                'label_attr' => [
                    'class' => 'formLabel'
                ],
            ])
            ->add('synopsis', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Once upon a time...',
                    'class' => 'formInput',
                ],
                'label' => 'Synopsis',
                'label_attr' => [
                    'class' => 'formLabel'
                ],
            ])
            ->add('poster', UrlType::class, [
                'attr' => [
                    'placeholder' => 'Url du poster',
                    'class' => 'formInput',
                ],
                'label' => 'Poster de la série',
                'label_attr' => [
                    'class' => 'formLabel'
                ],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'formInput',
                ],
                'label' => 'De quelle catégorie fait-il partie ?',
                'label_attr' => [
                    'class' => 'formLabel'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
