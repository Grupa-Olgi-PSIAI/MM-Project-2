<?php

namespace MMProjectBundle\Form;

use MMProjectBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class LicenseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('inventoryNumber')
            ->add('name')
            ->add('serialKey')
            ->add('validationDate')
            ->add('techSupportEndDate')
            ->add('purchaseDate')
            ->add('notes')
            ->add('user', EntityType::class, [
                'class' => 'MMProjectBundle:User',
                'choice_label' => function ($user) {
                    /** @var User $user */
                    return $user->getFirstName() . ' ' . $user->getLastName();
                }
            ])
            ->add('file', VichFileType::class, [
                'required' => false,
            ])
            ->add('invoice', EntityType::class, [
                'class' => 'MMProjectBundle:Invoice',
                'choice_label' => 'number'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MMProjectBundle\Entity\License'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mmprojectbundle_license';
    }


}
