<?php

namespace App\Form\Admin;

use App\Entity\Region;
use App\Entity\User;
use App\Security\Enum\PermissionEnum;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegionType extends AbstractType
{

    public function __construct(private readonly Security $security) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        /** @var User|null $connectedUser */
        $connectedUser = $this->security->getUser();

        $isDisabled = !$connectedUser->hasPermission(PermissionEnum::REGION_EDIT) && !$connectedUser->isSuperAdmin() ;

        $builder
            ->add('name', TextType::class, [
                'label' => 'Libellé',
                'attr' => [
                    'placeholder' => 'Libellé',
                    'class' => 'form-control',
                    'disabled' => $isDisabled,
                ],
            ])
            ->add('rattachements', CollectionType::class, [
                'entry_type' => RattachementType::class,
                'label' => 'Rattachements',
                "keep_as_list" => true,
                'allow_add' => true,
                'prototype' => true,
                'attr' => [
                    'disabled' => $isDisabled,
                ],
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Region::class
        ]);
    }
}
