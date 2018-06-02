<?php

namespace MMProjectBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class InvoiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('number', null, ['label' => 'number'])
            ->add('internalNumber', null, ['label' => 'internalNumber'])
            ->add('invoiceDate', null, ['label' => 'invoiceDate'])
            ->add('amountNet', null, ['label' => 'amountNet'])
            ->add('amountGross', null, ['label' => 'amountGross'])
            ->add('currency', null, ['label' => 'currency'])
            ->add('amountNetCurrency', null, ['label' => 'amountNetCurrency'])
            ->add('file', VichFileType::class, [
                'required' => false,
                'download_uri' => $options['fileUrl']
            ])
            ->add('contractor', EntityType::class, [
                'class' => 'MMProjectBundle:Contractor',
                'choice_label' => 'name',
                'label' => 'contractor'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MMProjectBundle\Entity\Invoice',
            'fileUrl' => true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mmprojectbundle_invoice';
    }


}
