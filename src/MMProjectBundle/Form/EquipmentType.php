<?php

namespace MMProjectBundle\Form;

use MMProjectBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipmentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('inventoryNumber', null, ['label' => 'inventoryNumber'])
            ->add('name', null, ['label' => 'name'])
            ->add('serialNumber', null, ['label' => 'serialNumber'])
            ->add('validationDate', null, ['label' => 'validationDate'])
            ->add('purchaseDate', null, ['label' => 'purchaseDate'])
            ->add('priceNet', null, ['label' => 'priceNet'])
            ->add('notes', null, ['label' => 'notes'])
            ->add('invoice', EntityType::class, [
                'class' => 'MMProjectBundle:Invoice',
                'choice_label' => 'number',
                'label' => 'invoice'
            ])
            ->add('user', EntityType::class, [
                'class' => 'MMProjectBundle:User',
                'choice_label' => function ($user) {
                    /** @var User $user */
                    return $user->getFirstName() . ' ' . $user->getLastName();
                },
                'label' => 'user'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MMProjectBundle\Entity\Equipment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mmprojectbundle_equipment';
    }


}
