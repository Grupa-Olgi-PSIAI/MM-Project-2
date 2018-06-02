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
        $builder->add('inventoryNumber', null, ['label' => 'inventoryNumber'])
            ->add('name', null, ['label' => 'name'])
            ->add('serialKey', null, ['label' => 'serialKey'])
            ->add('validationDate', null, ['label' => 'validationDate'])
            ->add('techSupportEndDate', null, ['label' => 'techSupportEndDate'])
            ->add('purchaseDate', null, ['label' => 'purchaseDate'])
            ->add('notes', null, ['label' => 'notes'])
            ->add('file', VichFileType::class, [
                'required' => false,
                'download_uri' => $options['fileUrl'],
                'label' => 'file'
            ])
            ->add('user', EntityType::class, [
                'class' => 'MMProjectBundle:User',
                'choice_label' => function ($user) {
                    /** @var User $user */
                    return $user->getFirstName() . ' ' . $user->getLastName();
                },
                'label' => 'user'
            ])
            ->add('invoice', EntityType::class, [
                'class' => 'MMProjectBundle:Invoice',
                'choice_label' => 'number',
                'label' => 'invoice'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MMProjectBundle\Entity\License',
            'fileUrl' => true
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
