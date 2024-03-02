<?php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mdp', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('nom', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('prenom', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('num', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('adresse', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('email', null, [
                'attr' => ['class' => 'form-control' ,'placeholder' => 'email']
            ])
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'Admin' => 'admin',
                    'Client' => 'client',
                    'Livreur' => 'livreur',
                    'Agent' => 'agent',
                    'Agent financier' => 'agent_financier',
                ],
                'placeholder' => '',
                'attr' => ['class' => 'form-control']
            ])
            ->add('status', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('secteur', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-hero btn-circled']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}