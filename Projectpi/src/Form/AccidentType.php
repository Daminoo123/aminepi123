<?php

namespace App\Form;

use App\Entity\Accident;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccidentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_accident', ChoiceType::class, [
                'choices' => [
                    'Collision' => 'Collision',
                    'Rear-end collision' => 'Rear-end collision',
                    'Side-impact collision' => 'Side-impact collision',
                    'Head-on collision' => 'Head-on collision',
                    'Rollover accident' => 'Rollover accident',
                    'Single-vehicle accident' => 'Single-vehicle accident',
                    'Multi-vehicle accident' => 'Multi-vehicle accident',
                    'Hit and run' => 'Hit and run',
                    'Pedestrian accident' => 'Pedestrian accident',
                    'Bicycle accident' => 'Bicycle accident',
                    'Motorcycle accident' => 'Motorcycle accident',
                    // Add more types as needed
                ],
            ])
            ->add('lieu_Accident', TextType::class)
            ->add('date_Accident', TextType::class, [
                'required' => false, // Make it optional
                'attr' => ['pattern' => '[0-9]*'] // Only accept numbers
            ])
            ->add('description_Accident', TextareaType::class)
            ->add('Accident_remorquage', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
                'expanded' => true, // Render as radio buttons
                'label' => 'Accident Remorquage?',
            ])
            ->add('constat', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
                'expanded' => true, // Render as radio buttons
                'label' => 'Constat?',
            ])
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Accident::class,
        ]);
    }
}
