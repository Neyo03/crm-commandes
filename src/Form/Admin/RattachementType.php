<?php

namespace App\Form\Admin;

use App\Entity\Rattachement;
use App\Entity\Region;
use App\Entity\User;
use App\Security\Enum\PermissionEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RattachementType extends AbstractType
{

    public function __construct(private readonly Security $security) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        /** @var User|null $connectedUser */
        $connectedUser = $this->security->getUser();

        $isDisabled = !$connectedUser->hasPermission(PermissionEnum::RATTACHEMENT_EDIT) && !$connectedUser->isSuperAdmin() ;

        $builder
            ->add('name', TextType::class, [
                'label' => 'Libellé',
                'attr' => [
                    'placeholder' => 'Libellé',
                    'class' => 'form-control mt-1',
                    'disabled' => $isDisabled,
                ],
            ])
        ;

        if ($options['standalone']) {
            $builder ->add('region', EntityType::class, [
                'class' => Region::class,
                'label' => 'Région du rattachement',
                'choice_label' => 'name',
                'attr' => [
                    'placeholder' => 'Séléctionner une région',
                    'class' => 'form-control',
                    'disabled' => $isDisabled,
                ],
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rattachement::class,
            'standalone' => false
        ]);
    }
}
