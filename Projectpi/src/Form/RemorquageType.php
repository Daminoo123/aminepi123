<?php
namespace App\Form;

use App\Entity\Remorquage;
use App\Entity\Accident;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Choice;

class RemorquageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etat_Remorquage', ChoiceType::class, [
                'label' => 'Type de remorquage',
                'choices' => [
                    'Assistance routière' => 'Assistance routière',
                    'Remorquage après accident' => 'Remorquage après accident',
                    'Remorquage d\'urgence' => 'Remorquage d\'urgence',
                    'Remorquage longue distance' => 'Remorquage longue distance',
                    'Remorquage local' => 'Remorquage local',
                    'Remorquage après vol' => 'Remorquage après vol',
                    'Récupération tout-terrain' => 'Récupération tout-terrain',
                    'Remorquage de VR ou de remorque' => 'Remorquage de VR ou de remorque',
                    // Ajoutez d'autres types de remorquage au besoin
                ],
                'placeholder' => 'Choisir le type de remorquage',
                'constraints' => [
                    
                    new Choice([
                        'choices' => [
                            'Assistance routière', 'Remorquage après accident', 'Remorquage d\'urgence',
                            'Remorquage longue distance', 'Remorquage local', 'Remorquage après vol',
                            'Récupération tout-terrain', 'Remorquage de VR ou de remorque'
                        ],
                        'message' => 'Choisissez un type de remorquage valide.'
                    ])
                ]
            ])
            ->add('num_user')
            ->add('id_user')
            ->add('accident', EntityType::class, [
                'class' => Accident::class,
                'choice_label' => 'lieu_Accident',
                'placeholder' => 'Choisir le lieu de l\'accident',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez fournir le lieu de l\'accident.'])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Remorquage::class,
        ]);
    }
}
