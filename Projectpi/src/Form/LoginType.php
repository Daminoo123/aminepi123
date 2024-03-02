<?php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', null, [
            'attr' => ['class' => 'form-control']
        ])
        ->add('mdp', null, [
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}