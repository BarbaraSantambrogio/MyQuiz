<?php

namespace App\Form;

use App\Entity\Quiz;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du Quiz',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Entrez le nom du quiz"
                ] 
                
            ])
            ->add('categorie', TextType::class, [
                'label' => 'Categorie du Quiz',
                'attr' => [
                'class' => 'form-control',
                'placeholder' => "Entrez la categorie"
                ] 
                
            ])
            ->add('question', TextType::class, [
                'label' => 'Question',
                'attr' => [
                'class' => 'form-control',
                'placeholder' => "Entrez la question"
                ] 
                
            ])
            ->add('reponse', TextType::class, [
                'label' => 'Réponse',
                'attr' => [
                'class' => 'form-control',
                'placeholder' => "Entrez la réponse"
                ] 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
