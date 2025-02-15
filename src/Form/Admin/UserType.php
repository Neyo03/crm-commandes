<?php

namespace App\Form\Admin;

use App\Entity\Rattachement;
use App\Entity\Region;
use App\Entity\User;
use App\Security\Enum\PermissionEnum;
use PharIo\Manifest\Email;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'form-control',
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'Super Admin' => 'ROLE_SUPER_ADMIN',
                ],
                'multiple' => true,
                'expanded' => true,
                'label' => 'Roles',
            ])
            ->add('permissions', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-check',
                ],
                'choice_attr' => [
                    'class' => 'form-check-input',
                ],
                'choices' => PermissionEnum::getChoices(),
                'multiple' => true,
                'expanded' => true,
                'label' => 'Permissions',
            ])
            ->add('regions', EntityType::class, [
                'class' => Region::class,
                'choice_label' => 'name',
                'multiple' => true,
                // 'expanded' => true,
                'label' => 'Régions',
                'attr' => [
                    'class' => 'form-check select-tools',
                ],
            ])
            ->add('rattachements', EntityType::class, [
                'class' => Rattachement::class,
                'choice_label' => 'name',
                'multiple' => true,
                // 'expanded' => true,
                'label' => 'Rattachements',
                'attr' => [
                    'class' => 'form-check select-tools',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
