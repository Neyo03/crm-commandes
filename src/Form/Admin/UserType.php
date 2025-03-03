<?php

namespace App\Form\Admin;

use App\Entity\Rattachement;
use App\Entity\Region;
use App\Entity\User;
use App\Security\Enum\PermissionCommandeEnum;
use App\Security\Enum\PermissionEnum;
use App\Security\Enum\RoleEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function __construct(private readonly Security $security) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        /** @var User|null $connectedUser */
        $connectedUser = $this->security->getUser();

        if (!$connectedUser instanceof User) {
            return;
        }

        $isDisabled = !$connectedUser->hasPermission(PermissionEnum::USER_EDIT) && !$connectedUser->isSuperAdmin() ;

        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'form-control',
                    'disabled' => $isDisabled,
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => RoleEnum::getChoices(),
                'multiple' => true,
                'expanded' => true,
                'label' => 'Roles',
                'disabled' => $isDisabled,
            ])
            ->add('permissions', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-check',
                ],
                'choice_attr' => [
                    'class' => 'form-check-input',
                ],
                'choices' => ['Administration' => PermissionEnum::getChoices(), 'Commande' => PermissionCommandeEnum::getChoices()],
                'multiple' => true,
                'expanded' => true,
                'label' => 'Permissions Administration',
                'disabled' => $isDisabled,
            ])
            ->add('regions', EntityType::class, [
                'class' => Region::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'multiple' => true,
                'required' => false,
                'label' => 'Régions',
                'attr' => [
                    'class' => 'select-tools',
                ],
                'disabled' => $isDisabled,
            ])
            ->add('rattachements', EntityType::class, [
                'class' => Rattachement::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'multiple' => true,
                'required' => false,
                'label' => 'Rattachements',
                'attr' => [
                    'class' => 'select-tools',
                ],
                'disabled' => $isDisabled,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
