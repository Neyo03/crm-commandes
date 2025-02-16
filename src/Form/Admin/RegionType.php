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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegionType extends AbstractType
{

    public function __construct(private Security $security) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        /** @var User|null $connectedUser */
        $connectedUser = $this->security->getUser();

        $isDisabled = !($connectedUser && method_exists($connectedUser, 'hasPermission') && $connectedUser->hasPermission(PermissionEnum::REGION_EDIT));
        $isDisabled = !$connectedUser->isSuperAdmin();

        $builder
            ->add('name', TextType::class, [
                'label' => 'Libellé',
                'attr' => [
                    'placeholder' => 'Libellé',
                    'class' => 'form-control',
                    'disabled' => $isDisabled,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Region::class
        ]);
    }
}
