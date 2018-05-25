<?php

namespace MMProjectBundle\Form;

use MMProjectBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttendanceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('timeIn')
            ->add('timeOut')
            ->add('notes')
            ->add('user', EntityType::class, [
                'class' => 'MMProjectBundle:User',
                'choice_label' => function ($user) {
                    /** @var User $user */
                    return $user->getFirstName() . ' ' . $user->getLastName();
                }
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MMProjectBundle\Entity\Attendance'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mmprojectbundle_attendance';
    }


}
